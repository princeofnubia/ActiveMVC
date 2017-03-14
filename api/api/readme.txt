WRITTEN BY OYEWO ABUBAKRI OLAITAN



INtroduction

I wrote this REST API following MVC pattern. Though, i coupled the V to the controller (api_endpoints)" since i am returning JSON by default(but you can try and break the coupling if you need more model for an endpoint).

Intent
 
I did that so we can add more endpoints and corresponding model in the api_endpoints and api_model folder respectively. I also didnt generalize the CRUD for the model. I wrote them separately in their respective model to avoid coupling. The CRUD may vary for the model overtime and i think one should prepare for that.
If you need to manipulate the queries in the model folder, you must understand eloquent as i use Eloquent ORM for database queries.

USAGE
if you need to write an endpoint you need to write its respective model by appending the endpoint name with _model. For example if you have an endpoint name tax.php, its corresponding model must be tax_model.php. I designed it this way following single responsibility principle. The model must extends Api_model which also extends the Eloquent ORM class.

I left the files in the endpoint and model to serve as examples for you. you can delete all of them and create your own endpoint and corresponding model.



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

	ORGANISATION ENDPOINT ROUTE
	
	organisation/createOrg 			accepted method=POST
	organisation/getOrg/$id 		accepted method=GET    
	organisation/deleteOrg/$id 		accepted method=DELETE
	organisation/updateOrg 			accepted method=PUT
	
	OUTLET ENPOINT ROUTE
	
	organisation/createOutlet 			accepted method=POST
	organisation/getOutlet/$id 			accepted method=GET    
	organisation/deleteOutlet/$id 		accepted method=DELETE
	organisation/updateOutlet 			accepted method=PUT
	
	TAX ENDPOINT ROUTE
	
	tax/createTax 						accepted method=POST
	tax/getTax/$id 						accepted method=GET    
	tax/deleteTax/$id 					accepted method=DELETE
	tax/updateTax 						accepted method=PUT
	
	TAXINSTITUTION ROUTE
	
	taxInstitution/createTaxInstitution 		accepted method=POST
	taxInstitution/getTaxInstitution/$id 		accepted method=GET    
	taxInstitution/deleteTaxInstitution/$id 	accepted method=DELETE
	taxInstitution/updateTaxInstitution 		accepted method=PUT


 **for ensure that form are url-encoded by setting this in the form attribute 'enctype'=>'application/x-www-form-urlencoded' otherwise PUT request might give unexpected error. This is what i observed while testing it with Postman
 ** if you are having issues then you can make correction in the api_endpoint $this->request_verifier('PUT'); change it to POST and correct accordingly
 ** If you want to query all records say tax you can write tax/getTax/all or leave it blank tax/getTax and it will return all tax records**
 ** form names must match the model names otherwise there will be error.

4. RESPONSE CODES FOR VARIOUS REQUESTs

[00] = "you dont have access to this API"; // or code 0 also aplies to general system defined error by third party modules.
[01] = "No endpoint specified for your request";
[02] = "Your request cannot be processed. Please spell properly";
[03] = "No endpoint exist for your request";

//general endpoint response
[4] = "No such record exist";
[5] = "Unable to create specified record";
[6] = "Unable to update requested record";
[7] = "Unable to delete requested record";
[8] = "record creation successfull";
[9] = "record updated successfully";
[10] = "record deleted successfully";
[11] = "Access denied for this request";
[12] = "Unsupported request for this endpoint";
[13] = "NO RECORD HAS BEEN ADDED YET";
[14] = "Error with POST variables";


Recent Implementation 
[23] = "Login fail. Invalid username or password";
[24] = "ACCESS DENIED. Invalid Token";
[25] = "ACCESS DENIED. No token provided";
[26] = "Access Denied. Invalid User";
[27] = "Access Denied. Token expire";

[31] = "No such email exist";
[32] = "RESET SUCCESSFULL";
[33] = "RESET FAILED";
[34] = "EMAIL ALREADY IN USE";

NEW ENDPOINT ROUTE

/resetPassword 							accepted method=POST headers = ['Authorization'=>'Bearer '.$token] {vars from /verifyEmail/q/q=$token}
/forgottenPassword 						accepted method=POST 
/login									accepted method=POST {email,password}
/verifyEmail/q/q=$token					accepted method=GET this will be coming from mailbox




#AUTHENTICATION

There is authentication mechanism in the system. The authentication system is token based compare to session based authentication that provides less security since it can be hijacked.

If you need to authenticate a particular endpoint, add $this->isAuthenticated() to construct function of that endpoint.

When a user logs in the system generates a token that comes along with the json data. The token are to be sent along with any request otherwise the user will fail to access any resricted resource. You are to inject the token in the header like so 
headers('Authorization', 'Bearer '+$token_that_i_sent_to_you); you can see that there is a space between Bearer and the token strings.

You should cached the generated token to the browser so that the client can make use it anytime it sends a request

In the config file you can see that we have time out set for the token to expire. set them to any value convinient for you since the system using it might be a finance app. If a token is expired system will throw an error that token has expire and access will be denied accordingly.

When a user tries to reset its password its details are returned and all of it must be posted again. this happens after a successful /verifyEmail/q/q=$token

When a user tries to reclaim his password after mail verification is successful a token is generated and must be sent to the headers of request sent to resetPassword/ otherwise the user will not be able to reset his password

You will find mail configuration in mail.php of api_config folder set the value as appropriate so that when error occurs token can be sent to the recipient mail box.


Please note
The documentation is not complete you may add yours as well. I created it for a project that has similar patterns of requirement, while also considering the fact that it might change over time.
Understanding of the API starts from the bootstrap file(api_innit.php) then API_CORE folder. the code are quite straight forward.

you can chat with me on 08104006343
You might also experience some bugs...I humbly request you to correct accordingly and pull it to the repo.