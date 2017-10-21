<?php
set_time_limit(0);
	include("../engine/User.class.php");
	include("../engine/App.class.php");

	$user = new User ();

	include("../engine/Db.class.php");

	$dbOracle = new Db ($user);
	
	$dbData = new DbData ($dbOracle);



	include("../engine/ReportPDF.class.php");
	$viewReport = new ReportPDF("Atend Prouni - Teste de Relatorio em PDF","G","P");


	//TEXT_COLOR -  Text Color. Array. @example: array(220,230,240)
	//TEXT_SIZE -  Text Font Size. Numeric. @example: 8
	//TEXT_ALIGN -  Text Align. String. Possible values: LRC (left, right, center). @example 'C'
	//TEXT_TYPE -  Text Font Type(Bold/Italic). String. Possible values: BI. @example: 'B'
	//VERTICAL_ALIGN -  Vertical alignment of the text. String. Possible values: TMB(top, middle, bottom). @example: 'M'
	//LINE_SIZE -  Line size for one row. Numeric. @example: 5
	//BACKGROUND_COLOR -  Cell background color. Array. @example: array(41, 80, 132)
	//BORDER_COLOR -  Cell border color. Array. @example: array(0,92,177)
	//BORDER_SIZE -  Cell border size. Numeric. @example: 0.2
	//BORDER_TYPE -  Cell border type. Mixed. Possible values: 0, 1 or a combination of: "LRTB". @example 'LRT'
	//TEXT -  Cell text. The text that will be displayed in the cell. String. @example: 'This is a cell'
	//PADDING_TOP -  Padding Top. Numeric. Expressed in units. @example: 5
	//PADDING_RIGHT -  Padding Right. Numeric. Expressed in units. @example: 5
	//PADDING_LEFT -  Padding Left. Numeric. Expressed in units. @example: 5
	//PADDING_BOTTOM -  Padding Bottom. Numeric. Expressed in units. @example: 5
	//TABLE_ALIGN -  Table aling on page. String. @example: 'C'
	//TABLE_LEFT_MARGIN -  Table left margin. Numeric. @example: 20
	//DRAW_HEADER -  Table draw header. Boolean @example: true or false
	//DRAW_BORDER -  Table draw header. Boolean @example: true or false
	//ROWSPAN
	//COLSPAN



	$arH[0]['TEXT'] = "ID";
	$arH[0]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');
	

	$arH[1]['TEXT'] = "STATE";
	$arH[1]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

	$arH[2]['TEXT'] = "PESSOA";
	$arH[2]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');

	$arH[3]['TEXT'] = utf8_encode("DESCRIÇÃO");
	$arH[3]['BACKGROUND_COLOR'] = $viewReport->Hex2RGB('789abc');




	$viewReport->GridHeader($arH,array(40,40,40,40,40));

	$dbData->Get("SELECT id, descricao, state_gsrecognize(state_id) as state, wpessoa_gsrecognize(wpessoa_id) as pessoa FROM ss WHERE rownum < 350 order by id desc");

	while ($abc = $dbData->Row())
	{

		$viewReport->GridContent(array("TEXT"=>$abc[ID]));
		$viewReport->GridContent(array("TEXT"=>$abc[STATE]));
		$viewReport->GridContent(array("TEXT"=>$abc[PESSOA]));
		$viewReport->GridContent(array("TEXT"=>$abc[DESCRICAO]));


	}


	unset($viewReport);

	/*
	include("../engine/ViewReport.class.php");
	$viewReport = new ViewReport("Teste",array("ID","State","WPessoa"));

	$dbData->Get("SELECT id, descricao, state_gsrecognize(state_id) as state, wpessoa_gsrecognize(wpessoa_id) as pessoa FROM ss WHERE rownum < 1500 order by id desc");

	while ($abc = $dbData->Row())
	{

		$viewReport->Content($abc[ID]);
		$viewReport->Content($abc[STATE]);
		$viewReport->Content($abc[PESSOA]);


	}*/

	unset($viewReport);


?>