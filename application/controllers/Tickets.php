<?php 
	class Tickets extends CI_Controller {

		public function sell_tickets() {//sell($raffle_id) {
			// First check if logged in
			if(!$this->session->userdata('logged_in')) {
				redirect('users/login');
			}

			$data['title'] = 'Sell Tickets';

			$this->form_validation->set_rules('ticket_quantity', 'Ticket Quantity', 'required');
			//$this->form_validation->set_rules('book_quantity', 'Book Quantity', 'required');
			$this->form_validation->set_rules('name', 'Customer Name', 'required');
			$this->form_validation->set_rules('phone', 'Customer Phone', 'required');
			$this->form_validation->set_rules('address', 'Customer Address', 'required');
			$this->form_validation->set_rules('email', 'Customer Email', 'required|valid_email');

			if(!$this->form_validation->run()) {
				$this->load->view('templates/header');
				$this->load->view('tickets/sell-tickets', $data);
				$this->load->view('templates/footer');
			} else {
				$ticket_quantity = $this->input->post('ticket_quantity');

				$book_quantity = $this->input->post('book_quantity');

				$total_tickets = $ticket_quantity + (3 * $book_quantity);

				$this->ticket_model->update_tickets($total_tickets);

				//Flashdata message needs to be changed to match others, unsure how currently
				$this->session->set_flashdata('ticket_sale', 'Sale of ' . $total_tickets . ' tickets successful!');

				// Send email to email indicated on ticket form //
				
				
			    redirect('tickets/sell_tickets');
			}
		}
	}