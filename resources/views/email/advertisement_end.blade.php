<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement End</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>

<body style="background:#e3e9ff; padding-top: 13px; padding-bottom: 20px;">

    <div class="invoice"
        style="margin:auto; margin-top:50px; background:#fff; padding:10px 30px; min-height:80vh; box-shadow: 1px 1px 6px 2px #a19696; border-radius:0.3rem; min-width:315px; max-width:550px;">
        <p style="text-align:center; color:green; margin-bottom: 40px; font-weight:700; font-size:20px;">Advertise on BhartiyaParampara - Ends Today!</p> 
        <div class="container">
            <div style="display:flex">
                <div class="logo" style="width:50%">
                <img src="https://bhartiyaparampara.com/public/build/assets/frontend/img/logo.png" alt="logo" style="width:200px;">
            </div>
            <div class="invoice_user_name" style="margin-left:auto;width:50%;"> 
                <p style="margin-top: 0; margin-bottom: 0.5rem; letter-spacing: 1px; word-spacing: 0px; line-height: 26px;"> 
                <p style="margin-top: 0; margin-bottom: 0.5rem; letter-spacing: 1px; word-spacing: 0px; line-height: 26px;">
                    <b>{{$mailData['email']}}</b></p>
                    <p>From: {{ \Carbon\Carbon::parse($mailData['start_date'])->format('d M, Y')}}</p> 
                    <p>To: {{ \Carbon\Carbon::parse($mailData['end_date'])->format('d M, Y')}}</p>  
            </div>
            </div>
        </div> 
        <hr>
        <div class="main-section" style="text-align: justify;"> 
            <p>Dear, {{$mailData['email']}},</p>
            <p>This is a friendly reminder that today is the final day to seize the opportunity to advertise on BhartiyaParampara Website. </p>
            <p>Don't let this chance slip away to showcase your brand to our engaged audience of N number of users or unique visitors. Act swiftly to secure your ad space by contacting us at “advertise@bhartiyaparampara.com” before the day concludes. </p>
            <p>We appreciate your interest in partnering with us and look forward to elevating your brand visibility.</p>
             
            <p>Best regards, <br>Bhartiya Parampara</p>
            <p></p>
        </div>
        <hr>
        <div class="main-section" style="text-align:center;">
            <ul style="list-style:none; margin-top: 30px; padding-left:0px !important">
                <li style="display:inline-block;  padding-right: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/about-us" style="text-decoration:none; color: #777777;" target="_blank">About Us</a></li>
                <li style="display:inline-block; padding-left: 10px; padding-right: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/contact-us" style="text-decoration:none; color: #777777;" target="_blank">Contact Us</a></li>
                <li style="display:inline-block; padding-left: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/privacy-policy" style="text-decoration:none; color: #777777;" target="_blank">Our Policy</a></li>
            </ul>
            <p>©  2020 Bhartiya Parampara</p>
        </div>
    </div>
    </div>

</body>

</html>