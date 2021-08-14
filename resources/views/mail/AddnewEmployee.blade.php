<h4> Hello <span style="color:blue">{{ $email_data["name"] }}</span></h4>

Your account has been created on TDG Client.
<h3>Account Details</h3>
<b>Email</b> :{{  $email_data["email"]  }}<br>
<b>Phone</b> :{{  $email_data["phone"]  }}<br>
<b>Password:</b>{{ $email_data["password"] }}<br><br>
Please click the link below to verify your account
<a href="http://127.0.0.1:8000/verify?code={{ $email_data["token"] }}">Click Here</a>

<br>
Thank You,<br>
Admin<br>
TDG Client
