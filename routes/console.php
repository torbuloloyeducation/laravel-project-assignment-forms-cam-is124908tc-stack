# Reflection Answers

## 1. What is the difference between GET and POST?
The GET method requests or retrieves information from a server, 
and the information can be seen in the URL. The POST method sends 
information to the server, like when submitting an HTML form, 
and the information is in the request body.

## 2. Why do we use @csrf in forms?
This is done using @csrf to ensure the form is secure from any 
malicious activities. CSRF stands for cross site request forgery 
where a token is used to confirm that the request is from a 
trustworthy origin.

## 3. What is session used for in this activity?
A session allows you to hold data temporarily at the server end 
in order to use it when accessing other pages. This data could 
be user details or data entered in a form.

## 4. What happens if session is cleared?
In case the session is deleted, all data stored within it would 
be erased. For instance, any login credentials or data that the 
user had saved would be deleted, prompting the user to re-login 
or input the data again.