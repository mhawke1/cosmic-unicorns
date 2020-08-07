<?php 

session_start();
	require_once 'swim.php';
	require $SWIM['basepath'].'../swim/stripe/init.php';

	$session=new session();
	$session->start();

	$db=new database();
	$db->databaseName($SWIM['dbDatabaseName']);
	$db->username($SWIM['dbUsername']);
	$db->password($SWIM['dbPass']);
	$db->connect();

            $request=new request();
			if($request->isPost())
				{   
					$title=$request->getPost('title',null);
					$code=$request->getPost('code',null);
					$typeId=$request->getPost('type_id',null);
					$discount=$request->getPost('discount',null);
					$description=$request->getPost('description',null);
					$min=$request->getPost('min',0);
					$id=$request->getPost('id',null);
					if(!empty($title))
						{
							
							$timestamp=time();
							if(!empty($id))
								{  
								
									 
									

											$db->query('UPDATE `coupon` SET `title`=\''.$title.'\' ,
												`code`=\''.$code.'\',
												`discount`=\''.$discount.'\' ,
                                                `description`=\''.$description.'\' ,
												`type_id`=\''.$typeId.'\' ,
												`min`=\''.$min.'\' 


												WHERE id='.$id);
											$updateResult=$db->exe();
											if($updateResult===false)
												{
													$msg='Something Went Wrong';
												}else {
													 $newURL=$SWIM['basepath']."coupon-index";
											         header('Location: '.$newURL);
													$success='Coupon Updated Successfully';
												}
										
								}else 
								{  
                                     

                                     $db->query('INSERT INTO `coupon`
									(title,code,discount,description,type_id,min,timestamp) VALUES
									("'.$title.'","'.$code.'","'.$discount.'","'.$description.'","'.$typeId.'","'.$typeId.'","'.$timestamp.'")');

									
									$insertResult=$db->exe();

									if($insertResult===false)
										{
											$msg='Something Went Wrong';
										}else {
                                              $newURL=$SWIM['basepath']."coupon-index";
											  header('Location: '.$newURL);

										
											$success='Coupon Added Successfully';

										}
								}
						}
				}
?>