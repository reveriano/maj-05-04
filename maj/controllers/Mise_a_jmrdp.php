<?php

/**
 * @NSHIMIRIMANA REVERIEN
 * DATE DEBUT :29/03/2022
 * DATE FIN :01/04/2022
 */
class Mise_a_jmrdp extends CI_Controller
{

	public function __construct(){
		parent::__construct();

		include APPPATH.'third_party/fpdf/pdfinclude/fpdf/mc_table.php';
		include APPPATH.'third_party/fpdf/pdfinclude/fpdf/pdf_config.php';
	}
	
	function index()
	{
		// $STAGE_ID=1;
		$data['title']="Mise à jour du titre foncier";

		$PROCESS_ID=$this->input->post('PROCESS_ID');

		// print_r($PROCESS_ID);die();


		$STAGE_ID=$this->input->post('STAGE_ID');
		$data['PROCESS_ID']=$PROCESS_ID;

		$data['stages']=$this->Model->getRequete("SELECT st.STAGE_ID,CONCAT(st.DESCRIPTION_STAGE,' (',(SELECT COUNT(*) FROM pms_maj_mdrp m WHERE m.`STAGE_ID`=st.STAGE_ID),')') STAGE FROM pms_stage st WHERE st.PROCESS_ID=".$PROCESS_ID);

		// print_r($STAGE_ID);die();
		$data['STAGE_ID']=$STAGE_ID;
		$this->load->view('Mise_a_jmrdp_applications_view',$data);
	}

	
	function application()
	{
		// code...
		// $STAGE_ID=1;


		//tableau de bord

		$data['my_tasks']=$this->Model->getRequete('SELECT * FROM `pms_maj_mdrp` WHERE 1');
		$data['complete']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE 1');

		$data['signed']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE (STAGE_ID=14 || STAGE_ID=15)');

		//

		
		$data['title']="Mise à jour du titre foncier";

		$PROCESS_ID=$this->input->post('PROCESS_ID');
		$STAGE_ID=$this->input->post('STAGE_ID');
		
		$condition="";

		if ($PROCESS_ID) {
			// code...
			$condition=" AND st.PROCESS_ID=".$PROCESS_ID;
		}

		$cond=0;
		if ($STAGE_ID) {
			$cond=$this->input->post('STAGE_ID');
		}

		$data['services']=$this->Model->getRequete("SELECT `PROCESS_ID`, `DESCRIPTION_PROCESS`, `TYPE_PROCESS_ID` FROM `pms_process` WHERE 1 AND (`DESCRIPTION_PROCESS` LIKE '%morc%' OR DESCRIPTION_PROCESS LIKE '%unification%' OR DESCRIPTION_PROCESS LIKE '%perte%' OR DESCRIPTION_PROCESS LIKE '%rioration%') ORDER BY DESCRIPTION_PROCESS ASC");

		$data['stages']=$this->Model->getRequete("SELECT st.STAGE_ID,CONCAT(st.DESCRIPTION_STAGE,' (',(SELECT COUNT(*) FROM pms_maj_mdrp m WHERE m.`STAGE_ID`=st.STAGE_ID),')') STAGE FROM pms_stage st WHERE 1 ".$condition);

		// print_r($PROCESS_ID);die();

		$data['STAGE_ID']=$cond;
		$data['PROCESS_ID']=$PROCESS_ID;

		

		$this->load->view('Mise_a_jmrdp_applications_view',$data);
	}

	function tasks()
	{
		$data['title']="Mise à jour du titre foncier";

		//tableau de bord

		$data['my_tasks']=$this->Model->getRequete('SELECT * FROM `pms_maj_mdrp` WHERE 1');
		$data['complete']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE 1');

		$data['signed']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE (STAGE_ID=14 || STAGE_ID=15)');

		//

		$this->load->view('Mise_a_jmrdp_tache_view',$data);
	}

	function complete()
	{
		$data['title']="Mise à jour du titre foncier";

		//tableau de bord

		$data['my_tasks']=$this->Model->getRequete('SELECT * FROM `pms_maj_mdrp` WHERE 1');
		$data['complete']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE 1');

		$data['signed']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE (STAGE_ID=14 || STAGE_ID=15)');

		//
		$this->load->view('Mise_a_jmrdp_tache_termines_view',$data);
	}

	function message()
	{
		$data['title']="Mise à jour du titre foncier";

		//tableau de bord

		$data['my_tasks']=$this->Model->getRequete('SELECT * FROM `pms_maj_mdrp` WHERE 1');
		$data['complete']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE 1');

		$data['signed']=$this->Model->getRequete('SELECT `HISTORIQUE_MAJ_MDR_ID`, `MAJ_ID`, `DATE_TRAITEMENT`, `STAGE_ID`, `UTILISATEUR_ID`, `DATE_PREVU`, `ACTION_ID`, `COMMENTAIRE` FROM `pms_historique_maj_mdr` WHERE (STAGE_ID=14 || STAGE_ID=15)');

		//

		$this->load->view('Mise_a_jmrdp_messages_view',$data);
	}




	function All_application()
	{
		$STAGE_ID=$this->input->post('STAGE_ID');

		$critere=($STAGE_ID) ? " AND mdr.STAGE_ID=".$STAGE_ID : " AND mdr.STAGE_ID=1";


		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';

		if($_POST['length'] != -1) {
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}


		$query_principal="SELECT mdr.MAJ_ID,mdr.STAGE_ID,mdr.PROCESS_ID,mdr.CODE_MAJ,DATEDIFF(NOW(),mdr.DATE_INSERTION) NBRE_JRS,DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y')SUBMITTED_ON_DATE,DATE_FORMAT(mdr.DATE_INSERTION,'%r')SUBMITTED_ON_HOUR,(SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID) STAGE,sp.fullname REQUERANT FROM pms_maj_mdrp mdr JOIN sf_guard_user_profile sp ON sp.id=mdr.CODE_DECLARANT WHERE 1".$critere;

		// mdr.STAGE_ID=".$STAGE_ID


		$order_column=array("mdr.MAJ_ID","mdr.CODE_MAJ","(SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID)","sp.fullname","DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y')","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER  BY mdr.MAJ_ID  DESC';
		

		$search = !empty($_POST['search']['value']) ? (" AND (mdr.CODE_MAJ LIKE '%$var_search%' OR DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y') LIKE '%$var_search%' OR DATE_FORMAT(mdr.DATE_INSERTION,'%r') LIKE '%$var_search%' OR (SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID) LIKE '%$var_search%' OR sp.fullname LIKE '%$var_search%')") : '';


		$critaire="";
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_data= $this->Model->datatable($query_secondaire);

		$data = array();
		$u=0;

		foreach ($fetch_data as $row) {


			$u++;
			$sub_array = array();
			$sub_array[]=$row->CODE_MAJ;
			$sub_array[]=$row->CODE_MAJ.'<br>'.'<span class="badge badge-light">'.$row->NBRE_JRS.' '.lang('days').'</span>';
			$sub_array[]=$row->STAGE;
			$sub_array[]=$row->SUBMITTED_ON_DATE.'<br>'.$row->SUBMITTED_ON_HOUR;   
			$sub_array[]=$row->REQUERANT;        

			

			$option = '<span data-toggle="tooltip" data-placement="top" title="'.lang('verifier_tooltip').'"><a class="btn btn-secondary btn-sm btn-lg" href="'.base_url('index.php/maj/Mise_a_jmrdp/view/'.$row->MAJ_ID.'/'.$row->PROCESS_ID.'/'.$row->STAGE_ID).'"><i class="fa fa-eye"></i></a></span>';
			
			$sub_array[]=$option;

			$data[] = $sub_array;

		}

		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);

		echo json_encode($output);

	}

	function My_tasks()
	{
		

		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';

		if($_POST['length'] != -1) {
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}


		$query_principal="SELECT mdr.MAJ_ID,mdr.STAGE_ID,mdr.PROCESS_ID,mdr.CODE_MAJ,DATEDIFF(NOW(),mdr.DATE_INSERTION) NBRE_JRS,DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y')SUBMITTED_ON_DATE,DATE_FORMAT(mdr.DATE_INSERTION,'%r')SUBMITTED_ON_HOUR,(SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID) STAGE,sp.fullname REQUERANT FROM pms_maj_mdrp mdr JOIN sf_guard_user_profile sp ON sp.id=mdr.CODE_DECLARANT WHERE 1";

		// mdr.STAGE_ID=".$STAGE_ID


		$order_column=array("mdr.MAJ_ID","mdr.CODE_MAJ","(SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID)","sp.fullname","DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y')","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER  BY mdr.MAJ_ID  DESC';
		

		$search = !empty($_POST['search']['value']) ? (" AND (mdr.CODE_MAJ LIKE '%$var_search%' OR DATE_FORMAT(mdr.DATE_INSERTION,'%D %M %Y') LIKE '%$var_search%' OR DATE_FORMAT(mdr.DATE_INSERTION,'%r') LIKE '%$var_search%' OR (SELECT st.DESCRIPTION_STAGE FROM pms_stage st WHERE st.STAGE_ID=mdr.STAGE_ID) LIKE '%$var_search%' OR sp.fullname LIKE '%$var_search%')") : '';


		$critaire="";
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_data= $this->Model->datatable($query_secondaire);

		$data = array();
		$u=0;

		foreach ($fetch_data as $row) {


			$u++;
			$sub_array = array();
			$sub_array[]=$row->CODE_MAJ;
			$sub_array[]=$row->CODE_MAJ.'<br>'.'<span class="badge badge-light">'.$row->NBRE_JRS.' '.lang('days').'</span>';
			$sub_array[]=$row->STAGE;
			$sub_array[]=$row->SUBMITTED_ON_DATE.'<br>'.$row->SUBMITTED_ON_HOUR;   
			$sub_array[]=$row->REQUERANT;        

			

			$option = '<span data-toggle="tooltip" data-placement="top" title="'.lang('verifier_tooltip').'"><a class="btn btn-secondary btn-sm btn-lg" href="'.base_url('index.php/maj/Mise_a_jmrdp/view/'.$row->MAJ_ID.'/'.$row->PROCESS_ID.'/'.$row->STAGE_ID).'"><i class="fa fa-eye"></i></a></span>';
			
			$sub_array[]=$option;

			$data[] = $sub_array;

		}

		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);

		echo json_encode($output);

	}

	function All_completed_tasks()
	{
		
		$var_search = !empty($_POST['search']['value']) ? $_POST['search']['value'] : null;

		$limit='LIMIT 0,10';

		if($_POST['length'] != -1) {
			$limit='LIMIT '.$_POST["start"].','.$_POST["length"];
		}


		$query_principal="SELECT mdrp.MAJ_ID,mdrp.PROCESS_ID,mdrp.STAGE_ID,mdrp.CODE_MAJ,(SELECT CONCAT(pp.DESCRIPTION_PROCESS,' >',st.DESCRIPTION_STAGE)  FROM pms_process pp JOIN pms_stage st ON st.PROCESS_ID=pp.PROCESS_ID WHERE st.STAGE_ID=mdr.STAGE_ID)DESCRIPTION_STAGE,mdr.DATE_TRAITEMENT,mdr.COMMENTAIRE,pp.DESCRIPTION_PROCESS,sf.fullname FROM pms_maj_mdrp mdrp JOIN pms_historique_maj_mdr mdr ON mdr.MAJ_ID=mdrp.MAJ_ID JOIN pms_process pp ON pp.PROCESS_ID=mdrp.PROCESS_ID JOIN sf_guard_user_profile sf ON sf.id=mdrp.CODE_DECLARANT WHERE 1";

		

		$order_column=array("mdrp.MAJ_ID","mdrp.CODE_MAJ","(SELECT CONCAT(pp.DESCRIPTION_PROCESS,' >',st.DESCRIPTION_STAGE)  FROM pms_process pp JOIN pms_stage st ON st.PROCESS_ID=pp.PROCESS_ID WHERE st.STAGE_ID=mdr.STAGE_ID)","sf.fullname","mdr.DATE_TRAITEMENT","");

		$order_by = isset($_POST['order']) ? ' ORDER BY '.$order_column[$_POST['order']['0']['column']] .'  '.$_POST['order']['0']['dir'] : ' ORDER  BY mdr.MAJ_ID  DESC';
		

		$search = !empty($_POST['search']['value']) ? (" AND (mdrp.CODE_MAJ LIKE '%$var_search%' OR mdr.DATE_TRAITEMENT LIKE '%$var_search%' OR (SELECT CONCAT(pp.DESCRIPTION_PROCESS,' >',st.DESCRIPTION_STAGE)  FROM pms_process pp JOIN pms_stage st ON st.PROCESS_ID=pp.PROCESS_ID WHERE st.STAGE_ID=mdr.STAGE_ID) LIKE '%$var_search%' OR sf.fullname LIKE '%$var_search%')") : '';


		$critaire="";
		$query_secondaire=$query_principal.' '.$critaire.' '.$search.' '.$order_by.'   '.$limit;
		$query_filter = $query_principal.' '.$critaire.' '.$search;

		$fetch_data= $this->Model->datatable($query_secondaire);

		$data = array();
		$u=0;

		foreach ($fetch_data as $row) {


			$u++;
			$sub_array = array();
			$sub_array[]=$row->CODE_MAJ.'<br>'.$row->DESCRIPTION_PROCESS;
			$sub_array[]=$row->DESCRIPTION_STAGE;   
			$sub_array[]=date('d-m-Y',strtotime($row->DATE_TRAITEMENT));        
			$sub_array[]=$row->fullname;        

			$option = '<span data-toggle="tooltip" data-placement="top" title="'.lang('verifier_tooltip').'"><a class="btn btn-secondary btn-sm btn-lg" href="#"><i class="fa fa-eye"></i></a></span>';
			
			$sub_array[]=$option;

			$data[] = $sub_array;

		}

		$output = array(
			"draw" => intval($_POST['draw']),
			"recordsTotal" =>$this->Model->all_data($query_principal),
			"recordsFiltered" => $this->Model->filtrer($query_filter),
			"data" => $data
		);

		echo json_encode($output);
	}


	function view($MAJ_ID=0,$PROCESS_ID=0,$STAGE_ID=0)
	{

		

		

		//get info table process_mjarp

		$data['info']=$this->Model->getRequeteOne('SELECT
			m.MAJ_ID,
			m.TYPE_DECLARANT_ID,
			m.CODE_MAJ,
			m.CODE_DECLARANT,
			m.PROCESS_ID,
			m.DATE_DECLARATION,
			m.DATE_VISITE,
			m.TECHNICIEN_ID,
			m.NUMERO_SPECIAL,
			m.NUMERO_ORDRE_GENERAL,
			m.NUMERO_VOLUME,
			m.NUMERO_FOLIO,
			m.PROVINCE_ID,
			m.COMMUNE_ID,
			m.AVENUE,
			m.SOUS_COLLINE,
			m.SUPERFICIE_HA,
			m.SUPERFICIE_ARE,
			m.SUPERFICIE_CA,
			m.SUPERFICIE_PV_HA,
			m.SUPERFICIE_PV_ARE,
			m.SUPERFICIE_PV_CA,
			m.NUMERO_PV,
			m.STAGE_ID,
			m.DATE_INSERTION,
			pro.PROVINCE_NAME,
			co.COMMUNE_NAME,
			z.ZONE_NAME,
			col.COLLINE_NAME,
			st.DESCRIPTION_STAGE,
			p.DESCRIPTION_PROCESS,
			sf.fullname,
			sf.email,
			sf.mobile
			FROM
			pms_maj_mdrp m
			LEFT JOIN
			provinces pro
			ON
			pro.PROVINCE_ID = m.PROVINCE_ID
			LEFT JOIN
			communes co
			ON
			co.COMMUNE_ID = m.COMMUNE_ID
			LEFT JOIN
			pms_zones z
			ON
			z.ZONE_ID = m.ZONE_ID
			LEFT JOIN
			collines col
			ON
			col.COLLINE_ID = m.COLLINE_ID
			LEFT JOIN
			pms_stage st
			ON
			st.STAGE_ID = m.STAGE_ID
			LEFT JOIN
			pms_process p
			ON
			p.PROCESS_ID = m.PROCESS_ID
			LEFT JOIN
			sf_guard_user_profile sf
			ON
			sf.id = m.CODE_DECLARANT
			WHERE
			m.PROCESS_ID='.$PROCESS_ID);

		$data['MAJ_ID']=$MAJ_ID;


		//stages
		$data['stages']=$this->Model->getRequete('SELECT STAGE_ID,DESCRIPTION_STAGE,PROCESS_ID FROM pms_stage WHERE PROCESS_ID='.$data['info']['PROCESS_ID']);
		// actions
		$data['actions']=$this->Model->getRequete('SELECT a.ACTION_ID,a.DESCRIPTION_ACTION,a.STAGE_ID,a.NEXT_STAGE FROM pms_action a  WHERE a.STAGE_ID='.$STAGE_ID.' AND TACHE=0');

		//tache a faire

		$data['tache']=$this->Model->getOne('pms_action',array('STAGE_ID'=>$STAGE_ID));
		$data['stage_title']=$this->Model->getRequeteOne("SELECT CONCAT(p.DESCRIPTION_PROCESS,' > ',st.DESCRIPTION_STAGE) STAGES FROM pms_stage st JOIN pms_process p ON p.PROCESS_ID=st.PROCESS_ID WHERE st.STAGE_ID=".$STAGE_ID);

		$data['payement']=$this->Model->getOne('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID));

		$data['num_paiement']=($data['payement']['MENTION']) ? ":".$data['payement']['MENTION'] : "" ;
		$data['status']=($data['payement']['EST_PAIE']==1) ? "payé": "pas encore payé" ;
		$data['MONTANT_PAIE']=number_format($data['payement']['MONTANT_PAIE'],0,' ',' ');

		// $data['title']="Mise";



		$this->load->view('Traitement_mise_a_jmrdp_view',$data);
	}

	function faire_tache($MAJ_ID=0,$STAGE_ID=0,$ACTION_ID=0)
	{
		$data['title']="";

		$data['MAJ_ID']=$MAJ_ID;
		$data['STAGE_ID']=$STAGE_ID;
		$data['ACTION_ID']=$ACTION_ID;
		// $data['PROCESS_ID']=$PROCESS_ID;
		$data['AVIS_TECHNIQUE']=$this->input->post('AVIS_TECHNIQUE');

		$data['next_stage']=$this->Model->getOne('pms_action',array('ACTION_ID'=>$ACTION_ID));
		$data['agent']=$this->Model->getRequete("SELECT `ID`,CONCAT(`NOM`,' ',`PRENOM`) AGENT FROM pms_agent_expertise WHERE 1 ORDER BY AGENT ASC");

		$data['terre_parcelle']=$this->Model->getRequete("SELECT `TERRE_PARCELLE_ID`, `DESC_TERRE_PARCELLE` FROM `pms_terre_parcelle` WHERE 1 ORDER BY DESC_TERRE_PARCELLE ASC");

		$data['equivalences']=$this->Model->getRequete("SELECT `EQUIVALENCE_ID`, `DESC_EQUIVALENCE` FROM `pms_equivance_partie` WHERE 1 ORDER BY DESC_EQUIVALENCE ASC");

		$data['parties']=$this->Model->getRequete("SELECT `PARTIE_ID`, `DESC_PARTIE` FROM `pms_parties_parcelle` WHERE 1 ORDER BY `DESC_PARTIE` ASC");

		// $objet=$this->Model->getOne('')
		if ($ACTION_ID==7) {
			// code...
			$data['objet']="Autorisation de morcellement de la parcelle n°594/Bub située à GIHANGA « BURINGA »";

		}elseif ($ACTION_ID==10) {
			// code...
			$data['article']=$this->Model->getOne('pms_tarifs',array('TARIF_ID'=>2));

		} elseif ($ACTION_ID==3) {
			$TECHNICIEN_ID=$this->input->post('TECHNICIEN_ID');
			$DATE_VISITE=$this->input->post('DATE_VISITE');

		}elseif ($ACTION_ID==7) {
			$EQUIVALENCE_ID=$this->input->post('EQUIVALENCE_ID');
			$TERRE_PARCELLE_ID=$this->input->post('TERRE_PARCELLE_ID');
			$PARTIE_ID=$this->input->post('PARTIE_ID');
		}
		
		$this->load->view('Faire_tache_view',$data);
	}


	//traiter les taches

	function traiter()
	{

		$MAJ_ID=$this->input->post('MAJ_ID');
		$STAGE_ID=$this->input->post('STAGE_ID');
		$ACTION_ID=$this->input->post('ACTION_ID');
		$NEXT_STAGE=$this->input->post('NEXT_STAGE');
		$AVIS_TECHNIQUE=$this->input->post('AVIS_TECHNIQUE');

		// print_r($NEXT_STAGE.'/'.$MAJ_ID);die();
		

		$get_process=$this->Model->getOne('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID));
		$PROCESS_ID=$get_process['PROCESS_ID'];


		if ($ACTION_ID==4) {
			// code...
			$this->form_validation->set_rules('AVIS_TECHNIQUE','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

			if (empty($_FILES['PATH_RAPPORT_ANALYSE']['name'])) 
			{
			// code...
				$this->form_validation->set_rules('PATH_RAPPORT_ANALYSE','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

			}


			if ($this->form_validation->run()==FALSE) 
			{
			// code...
			// $AVIS_TECHNIQUE=$this->input->post('AVIS_TECHNIQUE');
				$this->faire_tache($MAJ_ID,$STAGE_ID,$ACTION_ID);
			}else{

				$photoreperatoire =FCPATH.'/uploads/rapport_analyse';
				$photo_avatar="rapport-analyse".date('Ymdis').uniqid();
				$PATH_RAPPORT_ANALYSE= $_FILES['PATH_RAPPORT_ANALYSE']['name'];
				$config['upload_path'] ='./uploads/rapport_analyse/';
				$config['allowed_types'] = '*';
				$test = explode('.', $PATH_RAPPORT_ANALYSE);
				$ext = end($test);
				$name = $photo_avatar.'.'.$ext;
				$config['file_name'] =$name;
            if(!is_dir($photoreperatoire)) //create the folder if it does not already exists   
            {
            	mkdir($photoreperatoire,0777,TRUE);

            } 

            $this->upload->initialize($config);
            $this->upload->do_upload('PATH_RAPPORT_ANALYSE');
            $PATH_RAPPORT_ANALYSE=$config['file_name'];
            $data_image=$this->upload->data();



	          //insert expertise 

            $HISTORIQUE_MAJ_MDR_ID=$this->Model->insert_last_id('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID));

            $this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('AVIS_TECHNIQUE'=>$AVIS_TECHNIQUE,'STAGE_ID'=>$NEXT_STAGE));

	          //check if exist in pms_documents

            $CHECK_EXISTE_DOCS=$this->Model->getOne('pms_documents',array('MAJ_ID'=>$MAJ_ID));
            $rapport=array('PATH_RAPPORT_ANALYSE'=>$PATH_RAPPORT_ANALYSE);

	          // print_r($rapport);die();

            if ($CHECK_EXISTE_DOCS) {
	          	// code...
            	$this->Model->update('pms_documents',array('MAJ_ID'=>$MAJ_ID),$rapport);

            }else{
            	$this->Model->create('pms_documents',array('MAJ_ID'=>$MAJ_ID,'PATH_RAPPORT_ANALYSE'=>$PATH_RAPPORT_ANALYSE));
            }

            // redirect(base_url('maj/Mise_a_jmrdp/view/'.$MAJ_ID.'/'.$PROCESS_ID.'/'.$STAGE_ID));
            redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));



         }



      }elseif ($ACTION_ID==3) {
    	// code...
      	$this->form_validation->set_rules('TECHNICIEN_ID','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('DATE_VISITE','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	if ($this->form_validation->run()==FALSE) 
      	{
      		$this->faire_tache($MAJ_ID,$STAGE_ID,$ACTION_ID);

      	}else{
      		$TECHNICIEN_ID=$this->input->post('TECHNICIEN_ID');
      		$DATE_VISITE=$this->input->post('DATE_VISITE');

      		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('TECHNICIEN_ID'=>$TECHNICIEN_ID,'DATE_VISITE'=>$DATE_VISITE,'STAGE_ID'=>$NEXT_STAGE));
      		$this->Model->create('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID));

      		$getexpert=$this->Model->getOne('pms_agent_expertise',array('ID'=>$TECHNICIEN_ID));

      		$mailTo=$getexpert['EMAIL'];
      		$subject='Expertise';
      		$message="Cher ".$getexpert['NOM']." ".$getexpert['PRENOM'].',<br>vous êtes nommé à faire la descente sur terrain pour l\'expertise de la parcelle No 342 en date <b>'.$DATE_VISITE.'</b>';

      		$this->notifications->send_mail($mailTo,$subject,$cc_emails=array(),$message,$attach=array());

      		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));
      	}

      }elseif ($ACTION_ID==7) {

      	$this->form_validation->set_rules('TERRE_PARCELLE_ID','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('PARTIE_ID','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('EQUIVALENCE_ID','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	if ($this->form_validation->run()==FALSE) 
      	{
      		$this->faire_tache($MAJ_ID,$STAGE_ID,$ACTION_ID);
      	}else{

      		$OBJET_ATTESTATION=$this->input->post('OBJET_ATTESTATION');
      		$TERRE_PARCELLE_ID=$this->input->post('TERRE_PARCELLE_ID');
      		$PARTIE_ID=$this->input->post('PARTIE_ID');
      		$EQUIVALENCE_ID=$this->input->post('EQUIVALENCE_ID');

      		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('TERRE_PARCELLE_ID'=>$TERRE_PARCELLE_ID,'EQUIVALENCE_ID'=>$EQUIVALENCE_ID,'PARTIE_ID'=>$PARTIE_ID,'STAGE_ID'=>$NEXT_STAGE));

      		$this->Model->create('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID));

    		//attestation de morcellement

      		$this->attestation($MAJ_ID,$PROCESS_ID);

      		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

      	}

      }elseif ($ACTION_ID==9) 
      {
    	// code...

      	$this->form_validation->set_rules('SUPERFICIE_PV_HA','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('SUPERFICIE_PV_ARE','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('SUPERFICIE_PV_CA','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	$this->form_validation->set_rules('COMMENTAIRE','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	if ($this->form_validation->run()==FALSE) 
      	{
      		$this->faire_tache($MAJ_ID,$STAGE_ID,$ACTION_ID);
      	}else{

      		$SUPERFICIE_PV_HA=$this->input->post('SUPERFICIE_PV_HA');
      		$SUPERFICIE_PV_ARE=$this->input->post('SUPERFICIE_PV_ARE');
      		$SUPERFICIE_PV_CA=$this->input->post('SUPERFICIE_PV_CA');
      		$COMMENTAIRE=$this->input->post('COMMENTAIRE');

      		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('SUPERFICIE_PV_HA'=>$SUPERFICIE_PV_HA,'SUPERFICIE_PV_ARE'=>$SUPERFICIE_PV_ARE,'SUPERFICIE_PV_CA'=>$SUPERFICIE_PV_CA,'STAGE_ID'=>$NEXT_STAGE));

      		$this->Model->create('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID,'COMMENTAIRE'=>$COMMENTAIRE));

      		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

      	}
      }elseif ($ACTION_ID==10) {
    	// code...

      	$TARIF_ID=$this->input->post('TARIF_ID');
      	$MONTANT_PAIE=$this->input->post('MONTANT_PAIE');
      	$MENTION=$this->input->post('MENTION');


      	$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));
      	$this->Model->create('pms_facturation_maj_mdr',array('MONTANT_PAIE'=>$MONTANT_PAIE,'TARIF_ID'=>$TARIF_ID,'MAJ_ID'=>$MAJ_ID,'MENTION'=>$MENTION));

      	$this->Model->create('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID,'COMMENTAIRE'=>NULL));

      	$this->proforma($MAJ_ID);

      	redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));


      }elseif ($ACTION_ID==14) {
    	// code...

      	$DATE_TF=$this->input->post('DATE_TF');
      	$COMMENTAIRE=$this->input->post('COMMENTAIRE');

      	$this->form_validation->set_rules('DATE_TF','','trim|required',array('required'=>'<font style="color:red;font-size:14px;">Le champs est obligatoire</font>'));

      	if ($this->form_validation->run()==FALSE) 
      	{
      		// code...
      		$this->faire_tache($MAJ_ID,$STAGE_ID,$ACTION_ID);
      	}else{

      		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE,'DATE_TF'=>$DATE_TF));

      		$this->Model->create('pms_historique_maj_mdr',array('MAJ_ID'=>$MAJ_ID,'STAGE_ID'=>$STAGE_ID,'UTILISATEUR_ID'=>1,'DATE_PREVU'=>date('Y-m-d'),'ACTION_ID'=>$ACTION_ID,'COMMENTAIRE'=>$COMMENTAIRE));

      		//nouveau PV
      		$this->new_Qrcode($MAJ_ID);

      		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));
      	}




      }


   }


//faire une action

   function do_action($MAJ_ID=0,$ACTION_ID=0,$STAGE_ID=0,$NEXT_STAGE=0)
   {
    	// print_r($NEXT_STAGE);die();

   	if ($ACTION_ID==1) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==4) {

    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));


   	}elseif ($ACTION_ID==5) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));
   	}elseif ($ACTION_ID==8) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==11) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		$this->Model->update('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID),array('EST_PAIE'=>1));

   		//paiement du quittance
   		$this->quittance($MAJ_ID);

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==12) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}
   	elseif ($ACTION_ID==13) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));



   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==15) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==16) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}elseif ($ACTION_ID==17) {
    		// code...
   		$this->Model->create('pms_historique_maj_mdr',array('UTILISATEUR_ID'=>1,'ACTION_ID'=>$ACTION_ID,'STAGE_ID'=>$STAGE_ID,'DATE_PREVU'=>date('Y-m-d')));
   		$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('STAGE_ID'=>$NEXT_STAGE));

   		redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));

   	}


   }

	//


   function attestation($MAJ_ID=0)
   {


	// 

   	$getinfo=$this->Model->getRequeteOne("SELECT pdr.PROCESS_ID,prc.DESC_PARTIE,equ.DESC_EQUIVALENCE,fullname FROM pms_maj_mdrp pdr LEFT JOIN pms_parties_parcelle prc ON prc.PARTIE_ID=pdr.PARTIE_ID LEFT JOIN pms_terre_parcelle ptr ON ptr.TERRE_PARCELLE_ID=pdr.TERRE_PARCELLE_ID LEFT JOIN pms_equivance_partie equ ON equ.EQUIVALENCE_ID=pdr.EQUIVALENCE_ID LEFT JOIN sf_guard_user_profile sf ON sf.id=pdr.CODE_DECLARANT  WHERE pdr.MAJ_ID=".$MAJ_ID);

   	// print_r($getinfo);die();

   	$process_name="";
   	$process_name1="";
   	$process_name2="";

   	if ($getinfo['PROCESS_ID']==1) {
		// code...
   		$process_name="le morcellement";
   		$process_name1="de morcellement";
   		$process_name2="du morcellement";
   	}




   	$lien_sauvegarder = FCPATH.'uploads/attestation/';
   	if(!is_dir($lien_sauvegarder)){
   		mkdir($lien_sauvegarder,0777,TRUE); 
   	}

   	$pdf = new FPDF();
   	$pdf->AddPage();
	// $pdf->Image(base_url().'upload/background_image/Permit_bg.png',0,0,210, 297);
   	$pdf->SetFont('Times','',10);
   	$pdf->SetFont('Arial','B',12);
   	$pdf->Cell(185,25,'REPUBLIQUE DU  BURUNDI',0,1,'L');
   	$pdf->Image(base_url().'uploads/logo/logo_justice.jpeg',10,26,30,30);
   	$pdf->Ln(20);
   	$pdf->SetFont('Arial','B',12);
   	$pdf->Cell(185,5,'MINISTERE DE LA JUSTICE',0,1,'L');
   	$pdf->Cell(185,5,'DIRECTION DES TITRES FONCIERS ET',0,1,'L');
   	$pdf->SetFont('Arial','BU',12);
   	$pdf->Cell(90,5,'DU CADASTRE NATIONAL',0,1,'L');
   	$pdf->SetFont('Arial','',12);
   	$pdf->Ln(-49);
   	$pdf->Cell(187,5,'BUJUMBURA, le '.date('d/m/Y') ,0,1,'R');
   	$pdf->Ln(50);
   	$pdf->Cell(90,5,utf8_decode('Réf : 554/        /DTF/2022/M'),0,1,'L');
   	$pdf->SetFont('Arial','B',12);
   	$pdf->Cell(187,5,utf8_decode('A Mr/Mme '.$getinfo['fullname']),0,1,'R');
   	$pdf->SetFont('Arial','BU',12);
   	$pdf->Cell(187,5,utf8_decode('à BUJUMBURA'),0,1,'R');
   	$pdf->SetFont('Arial','',12);

   	$pdf->Ln(10);
   	$pdf->MultiCell(70,5,utf8_decode('OBJET:Autorisation '.$process_name1.' de la parcelle n°01/215'.$MAJ_ID.' située à GIHOSHA GIKUNGU'),'','L',false);

   	$pdf->Ln(8);
   	$pdf->Cell(187,5,utf8_decode('Monsieur,'),0,1,'L');

   	$pdf->Ln(5);
   	$pdf->MultiCell(187,5,utf8_decode('       Faisant suite à votre lettre du '.date('d-m-Y').' par laquelle vous demandez '.$process_name.' en '.$getinfo['DESC_PARTIE'].' parties '.$getinfo['DESC_EQUIVALENCE'].' de la  parcelle identifiée  sous rubrique, j\'ai  l\'honneur de porter à votre connaissance que je marque mon accord.'),'','L',false);
   	$pdf->Ln(5);

   	$pdf->MultiCell(187,5,utf8_decode('       Je vous demanderais par conséquent l\'approbation des Services de l\'Office Burundais de l\'Urbanisme, de l\'Habitat et de la Construction « OBUHA »pour permettre l\'enregistrement des  parcelles issues '.$process_name2.'.'),'','L',false);

   	$pdf->Ln(5);
   	$pdf->MultiCell(187,5,utf8_decode('Veuillez agréer, Monsieur, l\'expression de ma considération distinguée.'),'','L',false);

   	$pdf->Ln(10);
   	$pdf->SetFont('Arial','B',12);
   	$pdf->MultiCell(130,5,utf8_decode('Le Directeur des Titres Fonciers et du Cadastre National Salomon NIBIGIRA'),'','R',false);

   	$pdf->Ln(20);


   	$PATH_AUTORISATION='TITRE_FONCIER'.$titre['PATH_AUTORISATION'].date('Ymdhis').uniqid().$MAJ_ID.'.pdf';

	//check if exist in pms_documents

   	$CHECK_EXISTE_DOCS=$this->Model->getOne('pms_documents',array('MAJ_ID'=>$MAJ_ID));


	          // print_r($rapport);die();

   	if ($CHECK_EXISTE_DOCS) {
	          	// code...
   		$this->Model->update('pms_documents',array('MAJ_ID'=>$MAJ_ID),array('PATH_AUTORISATION'=>$PATH_AUTORISATION));

   	}else{
   		$this->Model->create('pms_documents',array('MAJ_ID'=>$MAJ_ID,'PATH_AUTORISATION'=>$PATH_AUTORISATION));
   	}





   	$this->Model->update('pms_documents',array('MAJ_ID'=>$MAJ_ID),array('PATH_AUTORISATION'=>$PATH_AUTORISATION));

   	$pdf->Output($lien_sauvegarder.$PATH_AUTORISATION,'F');

   }



   //Generer un Facture
public function proforma($MAJ_ID)
{



	$getinfo=$this->Model->getOne('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID));

	$utilisateur = $this->Model->getOne('sf_guard_user_profile',['id'=>$getinfo['CODE_DECLARANT']]);
	$facure=$this->Model->getOne('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID));

	$lien_sauvegarder = FCPATH.'uploads/proforma/';
   	if(!is_dir($lien_sauvegarder)){
   		mkdir($lien_sauvegarder,0777,TRUE); 
   	}
	

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image(base_url().'upload/background_image/Permit_bg.png',0,0,210, 297);
	$pdf->SetFont('Times','',10);

	$pdf->Cell(185,25,'BUJUMBURA, le '.date('d/m/Y') ,0,1,'R');

	$pdf->SetY(100);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(185,20,'PAIEMENT POUR LE MORCELLEMENT  #'.$MAJ_ID ,0,0,'C');
	$pdf->Ln(20);
	$pdf->SetFont('Times','',10);
	$pdf->MultiCell(175,5,utf8_decode("".lang('mr_mrs')." ". $utilisateur['fullname']." ".lang('content_proforma_1')."  ".$MAJ_ID." ".lang('content_proforma_2')." ".$superficie."."),0,0,FALSE);

	$pdf->Ln(20);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(10,5,'#',1,0,'R');
	$pdf->Cell(140,5,'MENTION',1,0,'L');
	$pdf->Cell(30,5,"".lang('amount_titre')."",1,1,'R');

	$pdf->SetFont('Times','',10);
	$pdf->Cell(10,5,1 ,1,0,'R');
	$pdf->Cell(140,5,utf8_decode($facure['MENTION']) ,1,0,'L');
	$pdf->Cell(30,5,number_format($facure['MONTANT_PAIE'],1,'.',' '),1,1,'R');
	$pdf->Ln(20);

	$PROFORMA='PROFORMA'.date('Ymdhis').$MAJ_ID.'.pdf';

	$this->Model->update('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID),array('PATH_FACTURE_MJDR'=>$PROFORMA));


    $pdf->Output($lien_sauvegarder.$PROFORMA,'F');
}



//Generer une quittance
public function quittance($MAJ_ID)
{



	$getinfo=$this->Model->getOne('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID));

	$utilisateur = $this->Model->getOne('sf_guard_user_profile',['id'=>$getinfo['CODE_DECLARANT']]);
	$facure=$this->Model->getOne('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID));

	$lien_sauvegarder = FCPATH.'uploads/quittance/';
   	if(!is_dir($lien_sauvegarder)){
   		mkdir($lien_sauvegarder,0777,TRUE); 
   	}
	

	$pdf = new FPDF();
	$pdf->AddPage();
	$pdf->Image(base_url().'upload/background_image/Permit_bg.png',0,0,210, 297);
	$pdf->SetFont('Times','',10);

	$pdf->Cell(185,25,'BUJUMBURA, le '.date('d/m/Y') ,0,1,'R');

	$pdf->SetY(100);
	$pdf->SetFont('Times','B',12);
	$pdf->Cell(185,20,'QUITTANCE POUR LE MORCELLEMENT  #'.$MAJ_ID ,0,0,'C');
	$pdf->Ln(20);
	$pdf->SetFont('Times','',10);
	$pdf->MultiCell(175,5,utf8_decode("Cher(ere), ". $utilisateur['fullname']." vous venez de payer une quittance pour le morcellement."),0,0,FALSE);

	$pdf->Ln(20);
	$pdf->SetFont('Times','B',10);
	$pdf->Cell(10,5,'#',1,0,'R');
	$pdf->Cell(140,5,'MENTION',1,0,'L');
	$pdf->Cell(30,5,"".lang('amount_titre')."",1,1,'R');

	$pdf->SetFont('Times','',10);
	$pdf->Cell(10,5,1 ,1,0,'R');
	$pdf->Cell(140,5,utf8_decode('QUITTANCE #'.$MAJ_ID) ,1,0,'L');
	$pdf->Cell(30,5,number_format($facure['MONTANT_PAIE'],1,'.',' '),1,1,'R');
	$pdf->Ln(20);

	$QUITTANCE='QUITTANCE'.date('Ymdhis').$MAJ_ID.'.pdf';

	$this->Model->update('pms_facturation_maj_mdr',array('MAJ_ID'=>$MAJ_ID),array('PATH_QUITTANCE'=>$QUITTANCE));

    $pdf->Output($lien_sauvegarder.$QUITTANCE,'F');
}


//generer 	QRCODE

function new_Qrcode($MAJ_ID)
{

	$get_info=$this->Model->getOne('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID));
	$data= array('TF' =>'#'.$get_info['MAJ_ID']);

	$PATH_QRCODE=$this->notifications->generateQrcode($data,$MAJ_ID);
	$this->Model->update('pms_maj_mdrp',array('MAJ_ID'=>$MAJ_ID),array('PATH_QRCODE' =>$PATH_QRCODE));

    redirect(base_url('index.php/maj/Mise_a_jmrdp/application'));
}



   function get_stages()
   {
   	$PROCESS_ID=$this->input->post('PROCESS_ID');

   	$requete=$this->Model->getRequete("SELECT st.STAGE_ID,CONCAT(st.DESCRIPTION_STAGE,' (',(SELECT COUNT(*) FROM pms_maj_mdrp m WHERE m.`STAGE_ID`=st.STAGE_ID),')') STAGE FROM pms_stage st WHERE st.PROCESS_ID=".$PROCESS_ID);

   	$options="<option value='Sélectionner'></option>";
   	foreach ($requete as $value) {
			// code...
   		$options.="<option value=".$value['STAGE_ID'].">".$value['STAGE']."</option>";
   	}

   	echo $options;
   }


}

?>