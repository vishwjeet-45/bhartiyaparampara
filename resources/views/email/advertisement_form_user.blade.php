<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advertisement form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia">
</head>

<body style="background:#e3e9ff; padding-top: 13px; padding-bottom: 20px;">

    <div class="invoice"
        style="margin:auto; margin-top:50px; background:#fff; padding:10px 30px; min-height:80vh; box-shadow: 1px 1px 6px 2px #a19696; border-radius:0.3rem; min-width:315px; max-width:700px;">
        <p style="text-align:center; color:green; margin-bottom: 40px; font-weight:700; font-size:20px;">Elevate Your Brand with BhartiyaParampara!</p> 
        <div class="container">
            <div style="display:flex">
                <div class="logo" style="width:50%">
                <img src="https://bhartiyaparampara.com/public/build/assets/frontend/img/logo.png" alt="logo" style="width:200px;">
            </div>
            <div class="invoice_user_name" style="margin-left:auto;width:50%;">
                <p
                    style="margin-top: 0; margin-bottom: 0.5rem; letter-spacing: 1px; word-spacing: 0px; line-height: 26px;">
                    <b>{{$mailData['name']}}</b></p>
                    <b>{{$mailData['phone']}}</b></p>
                <p style="margin-top: 0; margin-bottom: 0.5rem; letter-spacing: 1px; word-spacing: 0px; line-height: 26px;">
                    <b>{{$mailData['email']}}</b></p>
            </div>
            </div>
        </div>
        <hr>
        <div class="container">
            <div style="display:flex">
               
                <div style="width:50%;">
                    <p><strong>City</strong>- {{$mailData['city']}}</p>
                    <p><strong>Category</strong>- {{$mailData['category']}}</p>
                    <p><strong>Duration</strong>- {{$mailData['duration']}} Month</p>
                </div>
                <div style="width:50%;">
                    <p><strong>Ad Size</strong>- {{$mailData['size']}}</p>
                    <p><strong>Ad Position</strong>- {{$mailData['position']}}</p>
                </div>
            </div>
        </div>
        <hr>
        <div class="main-section" style="text-align: justify;">
            <p>Dear {{$mailData['name']}},</p> 
             <p>Greetings from BhartiyaParampara! </p>
             <p>We're excited to offer you the chance to showcase your brand with our advertising options. Choose from two dynamic ad sizes— Large and Small with three placing —tailored to maximize your impact on our diverse community of N number of users or unique visitors. Our platform provides an ideal space to engage with your target audience.</p>
             <p>For detailed information on rates, packages, and customization options, please reach out to our dedicated advertising team at advertise@bhartiyaparampara.com. Secure your ad space now and let's elevate your brand together!</p>
            <p>Best regards, <br> Team BhartiyaParampara</p>
            <p></p>
        </div>
        <hr>
        <div class="main-section" style="text-align:center;">
            <ul style="list-style:none; margin-top: 30px; padding-left:0px !important">
                <li style="display:inline-block;  padding-right: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/about-us" style="text-decoration:none; color: #777777;" target="_blank">About Us</a></li>
                <li style="display:inline-block; padding-left: 10px; padding-right: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/contact-us" style="text-decoration:none; color: #777777;" target="_blank">Contact Us</a></li>
                <li style="display:inline-block; padding-left: 10px; font-size: 14px;"><a href="https://bhartiyaparampara.com/pages/privacy-policy" style="text-decoration:none; color: #777777;" target="_blank">Our Policy</a></li>
            </ul>
            <p>© 2020 Bhartiya Parampara</p>
        </div>
    </div>
    </div>

</body>

</html>