<% Response.CodePage = 65001 %>
<%
'Declaring Variables
Dim smtpserver,youremail,yourpassword,smtpuser,ContactUs_Name,ContactUs_Email,Robot_test
Dim ContactUs_Body,Action,MailSent,ServiceInfo

MailSent = false	

youremail = "info@smart-language.com"
smtpserver = "smtp.pub-english.com"
smtpuser = "info@pub-english.com"
yourpassword = "Rt45ed67fcV"

' Grabbing variables from the form post
ContactUs_Name = Request("ContactUs_Name")
ContactUs_Email = Request("ContactUs_Email")
ContactUs_Body = Request("ContactUs_Body")
Action = Request("Action")
ServiceInfo = Request("ServiceInfo")
Robot_test = Request("Website_trp")
 
' Used to check that the email entered is in a valid format
Function IsValidEmail(Email)
	Dim ValidFlag,BadFlag,atCount,atLoop,SpecialFlag,UserName,DomainName,atChr,tAry1
	ValidFlag = False
		If (Email <> "") And (InStr(1, Email, "@") > 0) And (InStr(1, Email, ".") > 0) Then
			atCount = 0
			SpecialFlag = False
			For atLoop = 1 To Len(Email)
			atChr = Mid(Email, atLoop, 1)
				If atChr = "@" Then atCount = atCount + 1
				If (atChr >= Chr(32)) And (atChr <= Chr(44)) Then SpecialFlag = True
				If (atChr = Chr(47)) Or (atChr = Chr(96)) Or (atChr >= Chr(123)) Then SpecialFlag = True
				If (atChr >= Chr(58)) And (atChr <= Chr(63)) Then SpecialFlag = True
				If (atChr >= Chr(91)) And (atChr <= Chr(94)) Then SpecialFlag = True
			Next
			If (atCount = 1) And (SpecialFlag = False) Then
				BadFlag = False
				tAry1 = Split(Email, "@")
				UserName = tAry1(0)
				DomainName = tAry1(1)
			If (UserName = "") Or (DomainName = "") Then BadFlag = True
			If Mid(DomainName, 1, 1) = "." then BadFlag = True
			If Mid(DomainName, Len(DomainName), 1) = "." then BadFlag = True
				ValidFlag = True
			End If
		End If
		If BadFlag = True Then ValidFlag = False
		IsValidEmail = ValidFlag
End Function

If Action = "SendEmail" And Not ContactUs_Name = "" And Not IsValidEmail(ContactUs_Email) = "False" And Not ContactUs_Body = "" And Robot_test = "69" Then

        Dim strBody	
        strBody = strBody & "Jméno" & ": " & " " & ContactUs_Name & vbCrlf 
        'strBody = strBody & "E-mail" & ": " & " " & ContactUs_Email & vbCrlf 
        strBody = strBody & "Sdělení" & ": " & " " & ContactUs_Body & vbCrlf & vbCrlf 
        strBody = strBody & "Servisní informace" & ": " & vbCrlf & ServiceInfo

        Dim ObjSendMail
        Set ObjSendMail = CreateObject("CDO.Message") 
        
        'This section provides the configuration information for the remote SMTP server.

        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/sendusing") = 2 'Send the message using the network (SMTP over the network).
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpserver") = smtpserver
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpserverport") = 25 
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpusessl") = False 'Use SSL for the connection (True or False)
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpconnectiontimeout") = 60
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/smtpauthenticate") = 1 'basic (clear-text) authentication
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/sendusername") = smtpuser
        ObjSendMail.Configuration.Fields.Item ("http://schemas.microsoft.com/cdo/configuration/sendpassword") = yourpassword
        ObjSendMail.Configuration.Fields.Update

        'End remote SMTP server configuration section

        ObjSendMail.To = youremail
        ObjSendMail.Subject = "Pub-English: Zpráva z webu"
        ObjSendMail.From = ContactUs_Email
        ObjSendMail.TextBody = strBody
        ObjSendMail.Send

        Set ObjSendMail = Nothing 
        MailSent = true
End If


If MailSent Then
    ContactUs_Name = ""
    ContactUs_Email = ""
    ContactUs_Body = ""
%>
  <div class="alert alert-success">
  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
   	<strong>Odesláno!</strong> Vaše zpráva bude zpracována co nejdříve, jak to bude možné.
  </div>                        
<% End If %>
<div class="hr1" style="margin-bottom:10px;"></div>

<!-- Start Contact Form -->
<script>
    $(document).ready(function(){
        var serviceString = '- current URL: '+window.location.href+'\n'+
                            '- previous URL: <%= Request.ServerVariables("HTTP_REFERER") %> \n'+
                            '- user-agent: '+$.pgwBrowser().userAgent+'\n'+
                            '- browser: '+$.pgwBrowser().browser.name+' '+$.pgwBrowser().browser.fullVersion+'\n'+
                            '- resolution: '+$.pgwBrowser().viewport.width+'x'+$.pgwBrowser().viewport.height+'\n'+
                            '- OS: '+$.pgwBrowser().os.name+' '+$.pgwBrowser().os.fullVersion+'\n';
         $.get("http://ip-api.com/json/<%= Request.ServerVariables("REMOTE_ADDR") %>", function(data) {
              serviceString = serviceString +
                            '- country: '+data.country+'\n'+
                            '- region: '+data.regionName+'\n'+
                            '- city: '+data.city+'\n'+
                            '- ZIP: '+data.zip+'\n'+
                            '- lat: '+data.lat+', lon: '+data.lon+'\n'+
                            '- time zone: '+data.timezone+'\n'+
                            '- ISP: '+data.isp+'\n'+
                            '- org: '+data.org+'\n'+
                            '- reverse DNS: '+data.reverse+'\n'+
                            '- IP: '+data.query+'\n'+
                            '- status: '+data.status+', error message: '+data.message;
              $('#service-info-input').val(serviceString);
        });
    });
</script> 

<div id="contact-form" class="contatct-form">
    <div class="loader"></div>
    <form action="" class="contactForm" name="cform" method="post">
        <div class="row">
            <div class="col-md-6">
                <label for="name">Jméno<span class="required">*</span></label>
                <% If Action = "SendEmail" and ContactUs_Name = "" And Not MailSent Then
                       Response.Write("<span class=""name-missing"">Zadejte prosím svoje jméno</span>")
                   End If
                %> 
                <input id="name" name="ContactUs_Name" type="text" value="<% Response.Write(ContactUs_Name) %>"  size="30">
            </div>
            <div class="col-md-6">
                <label for="e-mail">E-mail<span class="required">*</span></label>
                <% If Action = "SendEmail" and IsValidEmail(ContactUs_Email) = "False" And Not MailSent Then
                       Response.Write("<span class=""email-missing"">Zadejte prosím svoji e-mail adresu</span>")
                   End If
                %> 
                <input id="e-mail" name="ContactUs_Email" type="text" value="<% Response.Write(ContactUs_Email) %>" size="30">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="message">Sdělení<span class="required">*</span></label>
                <% If Action = "SendEmail" and ContactUs_Body = "" And Not MailSent Then
                       Response.Write("<span class=""message-missing"">Jaké je vaše sdělení?</span>")
                   End If
                %> 
                <textarea id="message" name="ContactUs_Body" cols="45" rows="5"><% Response.Write(ContactUs_Body) %></textarea>
                <a href="#" class="btn-system btn-large" onclick="$('.contactForm').submit();">Odeslat</a>
            </div>
        </div>
        <input type="hidden" name="Action" value="SendEmail">
        <input type="hidden" name="ServiceInfo" value='' id='service-info-input'>
        <div id="spamprotirobotum">
             <input type="text" name="Website_trp" value="" id="protirobotum">
        </div>
        <script type="text/javascript">
          document.getElementById("protirobotum").value = "69";
          document.getElementById("spamprotirobotum").style.display = "none";
        </script>
    </form>
</div>
<!-- End Contact Form -->