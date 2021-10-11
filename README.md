# MVC_API
A backend MVC API written in PHPWRITTEN BY OYEWO ABUBAKRI OLAITAN




#SETUP CONFIGURATION
1. run composer to run dependencies
2. write your endpoint and corresponding model
3. you can use postman to test your api


0. RESPONSE FORMAT IS JSON FOR  REQUESTs. 

1. I wrote this API in XAMPP environment. You need to configure the .htaccess file to specify the base path of your
of the API in your project. For example, the API folder existed in folder "project_folder" of the htdocs directory. 
So in the .htaccess file, after the line RewriteBase, i specified the base path of the API like so: RewriteBase /project_folder/API

2. Specify your database configuration in the database.php  in the API_config folder 
		$config['driver'] = 'mysql';  //leave this as it is 
		$config['write']['host'] = 'localhost'; //specify your own host name
		$config['read']['host'] = 'localhost'; // specify your own host name
		$config['username'] = 'root';			// username to your host
		$config['passord'] = '';				// password to your host
		$config['database'] = 'org';			// specify name of your working database
		$config['charset'] = 'utf8';			// leave as it is 
		$config['collation'] = 'utf8_general_ci'; // leave as it is 
		$config['prefix'] = '';						// left blank 

3. API ENDPOINT ROUTE: URLs i specified for my endpoints

	
	TAX ENDPOINT ROUTE
	
	tax/createTax 						accepted method=POST
	tax/getTax/$id 						accepted method=GET    
	tax/deleteTax/$id 					accepted method=DELETE
	tax/updateTax 						accepted method=PUT

	user/createUSer 						accepted method=POST
	user/getUser/$id 						accepted method=GET    
	user/deleteUSer/$id 					accepted method=DELETE
	user/updateUser 						accepted method=PUT

 **ensure that form are url-encoded by setting this in the form attribute 'enctype'=>'application/x-www-form-urlencoded' otherwise PUT request might give unexpected error. This is what i observed while testing it with Postman
 ** if you are having issues then you can make correction in the api_endpoint $this->request_verifier('PUT'); change it to POST and correct accordingly
 ** If you want to query all records say tax you can write tax/getTax/all or leave it blank tax/getTax and it will return all tax records**
 ** form names must match the model names otherwise there will be error.
