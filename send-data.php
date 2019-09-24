<?php
//Test Connection
require_once("isdk.php");	
$app = new iSDK;

if( $app->cfgCon("hv197"))
{

$FirstName= $_REQUEST['firstname'];
$LastName= $_REQUEST['lastname'];
$Email= $_REQUEST['email'];
$Phone1= $_REQUEST['phone'];
$Birthday= $_REQUEST['birthdate'];
$custom_shoppingcartURL= $_REQUEST['custom_shoppingcartURL'];
$custom_ImageURL= $_REQUEST['custom_ImageURL'];
$custom_productTitle= $_REQUEST['custom_productTitle'];
$custom_productUsualPrice= $_REQUEST['custom_productUsualPrice'];
$custom_productIdscountedPrice= $_REQUEST['custom_productIdscountedPrice'];

$tags = $_REQUEST['tags'];
// $tags = 'sample1,sample2,sample3';

$contactId = $app->addWithDupCheck(array(
						'FirstName' => $FirstName,
						'LastName' => $LastName,
						'Email' => $Email,
						'Phone1' => $Phone1,
						'Birthday' => $Birthday,
						'_CustomshoppingcartURL' => $custom_shoppingcartURL,
						'_CustomImageURL' => $custom_ImageURL,
						'_Customproducttitle' => $custom_productTitle,
						'_CustomproductUsualPrice' => $custom_productUsualPrice,
						'_CustomProductIdscountedPrice' => $custom_productIdscountedPrice
						),
						'EmailAndName');
						
	$arr = explode(',', $tags);
	// print_r($arr);
	$table = 'ContactGroup';
	$limit = 1000;
	$page = 0;
	$queryData = array('Id' => '%'); 
	$selectedFields = array('Id','GroupName');
 
	$tagging =  $app->dsQuery($table, $limit, $page, $queryData, $selectedFields); 
	$loop=0;
	foreach($tagging as $tagging){ //Loop to display all tags current existing tags on Infusionsoft
		if($tagging['GroupName']==$arr[$loop]){
		
			$result = $app->grpAssign($contactId, $tagging['Id']);
		}
	$loop++;
	}

}
?>