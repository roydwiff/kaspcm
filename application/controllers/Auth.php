<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function index()
	{
		$is_api = $this->input->is_ajax_request() || $this->input->get_request_header('Content-Type') === 'application/json';

		if (!$is_api && $this->session->userdata('username')) {
			redirect('admin/index');
		}

		if ($is_api) {
			$input = json_decode(file_get_contents('php://input'), true);
			$username = $input['username'] ?? '';
			$password = $input['password'] ?? '';
			return $this->_cekLogin($username, $password, true);
		} else {
			$this->form_validation->set_rules('username', 'Username', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['menu'] = 'login';
				$data['judul'] = 'Login Page';
				$this->load->view('login', $data);
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$this->_cekLogin($username, $password, false);
			}
		}
	}

	private function _cekLogin($username, $password, $is_api = false)
	{
		$user = $this->db->get_where('users', ['username' => $username])->row_array();

		if ($user && $user['is_active'] == 1 && password_verify($password, $user['password'])) {
			$this->load->library('Authorization_Token');

			$token_data = [
				'user_id' => $user['user_id'],
				'username' => $user['username'],
				'role_id' => $user['role_id']
			];
			$token = $this->authorization_token->generateToken($token_data);

			if ($is_api) {
				return $this->output
					->set_content_type('application/json')
					->set_output(json_encode([
						'status' => true,
						'message' => 'Login sukses!',
						'token' => $token,
						'user' => $token_data
					]));
			} else {
				$this->session->set_userdata([
					'token' => $token,
					'user_id' => $user['user_id'],
					'username' => $user['username'],
					'role_id' => $user['role_id']
				]);
				redirect('admin/index'); // bisa juga arahkan berdasarkan role
			}
		} else {
			if ($is_api) {
				return $this->output
					->set_content_type('application/json')
					->set_output(json_encode([
						'status' => false,
						'message' => 'Username atau password salah.'
					]));
			} else {
				$this->session->set_flashdata('error', 'Username atau password salah.');
				redirect('auth');
			}
		}
	}





	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Logout successfully</div>');
		redirect('auth');
	}

	public function addUser()
	{
		$this->form_validation->set_rules('user', 'Full Name', 'trim|required');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[password1]');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Username must be unique!</div>');
			redirect('admin/user');
		} else {
			$data = [
				'user' => htmlspecialchars($this->input->post('user', TRUE)),
				'username' => htmlspecialchars($this->input->post('username')),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'img' => 'avatar.png',
				'role_id' => htmlspecialchars($this->input->post('role_id', TRUE)),
				'is_active' => 1
			];
			$this->m_auth->save($data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation account created successfully!</div>');
			redirect('admin/user');
		}
	}

	public function editUser()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$this->form_validation->set_rules('user', 'Full name', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('admin/user');
		} else {
			$upload_img = $_FILES['img']['name'];

			if ($upload_img) {
				$config['upload_path'] = 'assets/profil/';
				$config['allowed_types'] = 'jpg|gif|png|jpeg|JPG|PNG';
				$config['max_size'] = '1024';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('img')) {
					$def_img = $user['img'];
					if ($def_img != 'avatar.png') {
						unlink(FCPATH . 'assets/profil/' . $def_img);
					}
					$new_img = $this->upload->data('file_name');
					$this->db->set('img', $new_img);
				} else {
					echo $this->upload->display_errors();
				}
			}
			$data = [
				'user' => htmlspecialchars($this->input->post('user', TRUE)),
				'username' => htmlspecialchars($this->input->post('username', TRUE)),
				'role_id' => htmlspecialchars($this->input->post('role_id', TRUE)),
				'is_active' => htmlspecialchars($this->input->post('is_active', TRUE)),
				'email' => htmlspecialchars($this->input->post('email', TRUE))
			];
			$id = $this->input->post('user_id');
			$this->m_auth->update($data, $id);
			// var_dump($data, $id);			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User updated successfully!</div>');
			redirect('admin/user');
		}
	}

	public function delUser($id)
	{
		$this->m_auth->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User deleted successfully!</div>');
		redirect('admin/user');
	}

	public function changePassword()
	{
		$username = $this->session->userdata('username');
		$user = $this->db->get_where('users', ['username' => $username])->row_array();
		$this->form_validation->set_rules('current_password', 'Current Password', 'trim|required');
		$this->form_validation->set_rules('new_password1', 'New Password', 'trim|required|min_length[5]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm Password', 'trim|required|matches[new_password1]');
		if ($this->form_validation->run() == FALSE) {
			if ($user['role_id'] == 1) {
				redirect('admin');
			} else if ($user['role_id'] == 3) {
				redirect('users/unit1');
			} else if ($user['role_id'] == 5) {
				redirect('users/unit2');
			} else {
				redirect('users/warga');
			}
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if (!password_verify($current_password, $user['password'])) {
				if ($user['role_id'] == 1) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
					redirect('admin');
				} else if ($user['role_id'] == 3) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
					redirect('users/unit1');
				} else if ($user['role_id'] == 2) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
					redirect('users');
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong current password!</div>');
					redirect('users/warga');
				}
			} else {
				// password tidak boleh sama
				if ($current_password == $new_password) {
					if ($user['role_id'] == 1) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password must be diferent from current password!</div>');
						redirect('admin');
					} else if ($user['role_id'] == 3) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password must be diferent from current password!</div>');
						redirect('users/unit1');
					} else if ($user['role_id'] == 2) {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password must be diferent from current password!</div>');
						redirect('users');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">New password must be diferent from current password!</div>');
						redirect('users/warga');
					}
				} else {
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);
					$password = $this->input->post('password', $password_hash);

					$this->db->set('password', $password_hash)
						->where('username', $username)
						->update('users');

					if ($user['role_id'] == 1) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed successfully</div>');
						redirect('admin');
					} else if ($user['role_id'] == 3) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed successfully</div>');
						redirect('user/manager');
					} else if ($user['role_id'] == 2) {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed successfully</div>');
						redirect('users');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password changed successfully</div>');
						redirect('users/warga');
					}
				}
			}
		}
	}

	public function resetPassword()
	{
		$this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[5]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[5]|matches[password1]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password failed to reset!</div>');
			redirect('admin/user');
		} else {
			$id = $this->input->post('user_id');
			$password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);

			$this->db->set('password', $password)
				->where('user_id', $id)
				->update('users');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password has been reseted!</div>');
			redirect('admin/user');
		}
	}
}

/* End of file Controllername.php */
