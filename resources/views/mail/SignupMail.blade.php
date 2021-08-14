<h4> Hello <span style="color:blue">{{ $email_data["name"] }}</span></h4><br><br>

Thank you for joining TheDevGarden Client
Please click the link below to verify your account
<a href="http://127.0.0.1:8000/verify?code={{ $email_data["verfication_code"] }}">Click Here</a>

<br>
<br>
Thank You,<br>
Admin<br>
TDG Client
