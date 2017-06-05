<?php
include './application/models/model_vacancy.php';

class Controller_Candidate extends Controller
{

	function __construct()
	{
		$this->model = new Model_Candidate();
		$this->view = new View();
	}
	
	function action_index()
	{
		$data = $this->model->get_data();		
		$this->view->generate('vacancy_view.php', 'template_view.php', $data);

	}

	function action_list(){
		if(isset($_GET['remove_id'])){
			$id = $_GET['remove_id'];
			$this->model->remove($id);
		}
		$data['candidates'] = $this->model->get_candidates();
		$this->view->generate('candidate_list_view.php', 'template_view.php', $data);
	}

	function action_add(){
		if(isset($_POST['form'])){
			$form = $_POST['form'];
			$this->model->add($form);
		} 

		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$person = $this->model->get_person($id);
			$data['person'] = $person[$id];
			$data['person']['id'] = $id;

			$this->view->generate('add_candidate_view.php', 'template_view.php', $data);
		}


		$vacancyModel = new Model_Vacancy();
		$vacancies = $vacancyModel->get_vacancies();
		$data['vacancies'] = $vacancies;			
		
		$this->view->generate('add_candidate_view.php', 'template_view.php', $data);
	}

}