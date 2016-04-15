<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }


        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
            z-index: 999999999;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="background-image">
</div>
<div class="container">
    <div class="content">
        @if(\Session::has('errors'))
            @foreach(\Session::get('errors') as $error)
                {{$error}}
            @endforeach
        @endif
        <h1 style="text-align: center">Register Here..</h1>
        <form method="post" action="{{route('register')}}" enctype="multipart/form-data">
            <div class="form-group">
                <label> First Name</label>
                <input type="text" class="form-control input-sm" name="fName" required>


                <label>Last Name</label>
                <input type="text" class="form-control input-sm" name="lName" required>

                <label>Email</label>
                <input type="text" class="form-control input-sm" name="email" required>

                <label>Passwod</label>
                <input type="password" class="form-control input-sm" name="password" required>


                <label>Confirm Password</label>
                <input type="password" class="form-control input-sm" name="passwordAgain" required>


                <label>Phone</label>
                <input type="text" class="form-control input-sm" name="phone" required>

                <label>Cell</label>
                <input type="text" class="form-control input-sm" name="mobile">

                <label>Address</label>
                <input type="text" class="form-control input-sm" name="address">
                <label>Zip Code</label>
                <input type="text" class="form-control input-sm" name="zipCode">
                <label>User Role</label>
                <select class="form-control input-sm" name="userRoles[]" required multiple>
                    <option value="1">Owner</option>
                    <option value="3">Agent</option>
                    <option value="2" >Tenant</option>
                    <option value="4">Other</option>
                </select>
                <div class="Agency-detail">
                    <h3>Agency Detail</h3>
                    <label> Agency Name</label>
                    <input type="text" class="form-control input-sm" name="agencyName" required>
                    <label> Description of Services</label>
                    <textarea class="form-control input-sm" name="agencyDescription" required></textarea>
                </div>
                <div class="Agency-detail">
                    <h4>Agency Contact Detail</h4>
                    <label>Company Phone</label>
                    <input type="text" class="form-control input-sm" name="companyPhone" required>
                    <label>Company Mobile</label>
                    <input type="text" class="form-control input-sm" name="companyMobile">
                    <label>Company Address</label>
                    <input type="text" class="form-control input-sm" name="companyAddress" required>
                    <label>Company Email</label>
                    <input type="email" class="form-control input-sm" name="companyEmail" required>
                    <div class="code-sec">
                        <label>Security Code</label>
                        <input type="text"  name="securityCode" required>
                        <img src="images/text.png">
                    </div>
                    <input type="file" name="companyLogo">
                    <hr>
                    <label><input type="checkbox" value="1" name="termsConditions"> I have read and agree to property42.pk Terms and Conditions</label>
                    <label>
                        <input type="checkbox" value="1" name="wantNotifications"> I want to receive notifications for promotions, newsletters
                        and website updates
                    </label>
                </div>

                <button type="submit" class="btn btn-default btn-sm">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
