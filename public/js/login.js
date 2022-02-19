function validate(){
   user = document.getElementById('username').value;
   pass = document.getElementById('password').value;

   if(user.length == " " && user.length < 5){
    document.getElementById('usererr').innerHTML = " Enter valid user name";
    return false;

   }
   if(pass.length == " " && pass.length < 6){

    document.getElementById('passerr').innerHTML = " Enter a valid password";
    return false;

   }
   return true;
}

function validateUser(){
    user = document.getElementById('username').value;

   if(user.length == " "){
    document.getElementById('usererr').innerHTML = " Enter valid user name";
    return false;

   }
   if(user.length < 5){
      document.getElementById('usererr').innerHTML = "Username must be of 6 character ";
    return false;
   }
   return true;

}

function validatePass(){
   pass = document.getElementById('pass').value;
   cpass = document.getElementById('cpass').value;

   
   if(pass == ""){
      document.getElementById('passerr').innerHTML = "Please fill the password";    
      return false;
  }
  if((pass.length <= 5)||(pass.length >30))
  {
      document.getElementById('passerr').innerHTML = "Password must contain 6 to 30 character";    
      return false;
  }
  if(cpass == ""){
      document.getElementById('cpasserr').innerHTML = "Please fill the confirm password";    
      return false;
  }
  if((cpass.length <= 5)||(cpass.length >30))
  {
      document.getElementById('cpasserr').innerHTML = "Confirm Password must contain 6 to 30 character";    
      return false;
  }
   if(pass != cpass){
    document.getElementById('err').innerHTML = " Password and confirm password must be same..";
    return false;
   }
   return true;
}
