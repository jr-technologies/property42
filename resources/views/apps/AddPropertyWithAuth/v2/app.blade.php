@extends('frontend.v2.frontend')
@section('content')
    <script type='text/javascript' >
        var appName = 'addPropertyWithAuth';
    </script>
    <!--    <link media="all" rel="stylesheet" href="--><?//= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?><!--/css/addPropertyForm.css">-->
    <!--    <link media="all" rel="stylesheet" href="--><?//= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?><!--/css/propertyListings.css">-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/css/select2.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/css/addPropertyNgSelect.css">
    <link media="all" rel="stylesheet" href="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/css/selectize.default.css">

    <link rel="stylesheet" href="<?= url('/') ?>/javascripts/ui-select/select.min.css">

    <!-- Angularjs Libs -->
    <script src="<?= url('/') ?>/assets/js/env.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular/angular.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-sanitize.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-select/select.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angularfire.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ng-file-upload/ng-file-upload-all.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/angular-route/angular-route.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/ui-router/angular-ui-router.min.js"></script>
    <script src="<?= url('/') ?>/javascripts/checklist-model.js"></script>

    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/app.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/models/Model.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/directives/appDirectives.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/services/AuthService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/services/CustomHttpService.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/services/ErrorResponseHandler.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/services/RouteHelper.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/services/ResourceLoader.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/controllers/ParentController.js"></script>
    <!--        Custoemrs Controllers       -->
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/controllers/property/AddPropertyController.js"></script>
    <script src="<?= \App\Libs\Helpers\AppHelper::path('addPropertyWithAuth', $response['version']) ?>/routes.js"></script>

    <div id="content" ng-app="addPropertyWithAuth">
            <div class="container loading_content_class" ng-controller="ParentController">
                <div class="addProperty-form container {{please_wait_class}}" ng-controller="AddPropertyController"  ng-init="initialize()">
                    <div class="add-form-holder"  ng-show="propertySaved == false">
                        <h1>Add <span>Property</span></h1>
                        <div class="main-form">
                            <ul class="error">
                                <li data-ng-repeat="error in errors"><span>{{error[0]}}</span></li>
                            </ul>
                            <form class="property-add" ng-submit="submitProperty()">
                                <strong class="add-pro-heading"><span>property for</span></strong>
                                <ul class="radio-checks-holder text-center">
                                    <li>
                                        <label for="for-sale" class="custom-withouChecks transparent">
                                            <input type="radio" name="add-for" id="for-sale" value="1" ng-model="form.data.propertyPurpose">
                                            <span class="fake-label">For Sale</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label for="for-rent" class="custom-withouChecks transparent">
                                            <input type="radio" name="add-for" id="for-rent" value="2" ng-model="form.data.propertyPurpose">
                                            <span class="fake-label">For Rent</span>
                                        </label>
                                    </li>
                                </ul>
                                <strong class="add-pro-heading"><span>Property Type</span></strong>
                                <ul class="radio-checks-holder text-center">
                                    <li data-ng-repeat="type in types">
                                        <label for="{{type.name}}" class="custom-withouChecks transparent">
                                            <input type="radio" name="propertyType" ng-model="$parent.form.data.propertyType" value="{{type.id}}" id="{{type.name}}" class="addPro-type">
                                            <span class="fake-label">{{type.name}}</span>
                                        </label>
                                    </li>
                                </ul>
                                <ul class="radio-checks-holder subtype-links hidden">
                                    <li data-ng-repeat="subType in subTypes | filter:{propertyTypeId : form.data.propertyType}">
                                        <label for="{{subType.name}}" class="customRadio">
                                            <input type="radio" ng-change="propertySubTypeChanged()" name="propertySubType" ng-model="$parent.form.data.propertySubType" id="{{subType.name}}" value="{{subType.id}}">
                                            <span class="fake-radio"></span>
                                            <span class="fake-label">{{subType.name}}</span>
                                        </label>
                                    </li>
                                </ul>
                                <strong class="add-pro-heading"><span>Property Location</span></strong>
                                <div class="layout clearfix">
                                    <div class="layout-holder">
                                        <label class="required-field">Socity</label>
                                        <div class="input-holder">
                                            <ui-select ng-model="temp.society" theme="select2" ng-change="societyChanged()" ng-disabled="ctrl.disabled" title="Choose a Society" required >
                                                <ui-select-match placeholder="select a society...">{{$select.selected.name}}</ui-select-match>
                                                <ui-select-choices refresh="searchSocieties($select)" refresh-delay="300" repeat="society in societies">
                                                    <div ng-bind-html="society.name"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <label class="required-field">Block</label>
                                        <div class="input-holder">
                                            <ui-select ng-model="temp.block" theme="select2" ng-change="blockChanged()" ng-disabled="ctrl.disabled" title="Choose a Block" required>
                                                <ui-select-match placeholder="select a Block...">{{$select.selected.name}}</ui-select-match>
                                                <ui-select-choices repeat="block in blocks | propsFilter: {name: $select.search} | filter : {societyId : temp.society.id}">
                                                    <div ng-bind-html="block.name | highlight: $select.search"></div>
                                                </ui-select-choices>
                                            </ui-select>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label for="property-title">Property Title</label>
                                        <div class="input-holder">
                                            <input type="text" name="propertyTitle" placeholder="Please add property title" ng-model="form.data.propertyTitle" id="property-title"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label class="required-field" for="land-area">Area</label>
                                        <div class="input-holder">
                                            <input type="number" step="any" placeholder="Area of Property" ng-model="form.data.landArea" min="1" id="land-area" required >
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <label class="required-field" for="land-unit">Unit</label>
                                        <div class="input-holder">
                            <span class="fake-select">
                                <select name="land_unit" ng-model="form.data.landUnit" id="land-unit" required>
                                    <option value="" selected disabled >Please Choose...</option>
                                    <option data-ng-repeat="unit in resources.landUnits" value="{{unit.id}}">{{unit.name}}</option>
                                </select>
                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder">
                                        <label class="required-field" for="property-price">Price</label>
                                        <div class="input-holder">
                                            <input type="number" min="1" class="PriceField" placeholder="Please enter the price" name="price" ng-model="form.data.price" id="property-price" required >
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="calculatedPrice">Price must contain numbers only</span>
                                    </div>
                                </div>
                                <div class="layout full-width">
                                    <div class="layout-holder">
                                        <label for="description">Description</label>
                                        <div class="input-holder">
                                            <textarea name="propertyDescription" placeholder="Please write about your property" ng-model="form.data.propertyDescription" id="description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout">
                                    <div class="layout-holder" ng-repeat="feature in highPriorityFeatures">
                                        <label>{{feature.name}}:</label>
                                        <div class="input-holder">
                                            <span my-directive my-text="helo" htmlStructure="{{feature.htmlStructure.html}}"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout full-width">
                                    <div class="input-holder">
                                        <a class="extra-features">Extra Feature</a>
                                    </div>
                                </div>
                                <div class="list-extraFeatures">
                                    <div class="col" data-ng-repeat="featureSection in subTypeAssignedFeatures">
                                        <span class="feature-heading">{{featureSection.sectionName}}</span>
                                        <div class="layout">
                                            <div class="layout-holder" ng-repeat="feature in featureSection.features">
                                                <label>{{feature.name}}</label>
                                                <div class="input-holder">
                                                    <span my-directive my-text="helo" htmlStructure="{{feature.htmlStructure.html}}"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <strong class="add-pro-heading"><span>Attachments</span></strong>
                                <ul class="image-uploading-area">
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.mainFile.file" onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb1" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.mainFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.twoFile.file" onchange="previewAddPropertyImg(this , '.img-thumb2')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb2" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(1)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.twoFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.threeFile.file" onchange="previewAddPropertyImg(this , '.img-thumb3')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb3" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(2)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.threeFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.fourFile.file" onchange="previewAddPropertyImg(this , '.img-thumb4')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb4" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(3)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.fourFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.fiveFile.file" onchange="previewAddPropertyImg(this , '.img-thumb5')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb5" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(4)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.fiveFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.sixFile.file" onchange="previewAddPropertyImg(this , '.img-thumb6')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb6" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(5)"><span class="icon-cross"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.sixFile.title" class="picture-name disableInput" placeholder="Title">
                                    </li>
                                </ul>
                                <strong class="add-pro-heading"><span>User Details</span></strong>
                                <ul class="existingOrNew-member">
                                    <li>
                                        <input type="radio" ng-model="form.data.memberType" value="1" name="radio" id="existing-member" checked>
                                        <label for="existing-member">Existing Member</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <label for="email">E-mail ID</label>
                                                <div class="input-holder">
                                                    <input type="text" name="login_email" placeholder="Email" ng-model="form.data.loginDetails.email">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="password">Password</label>
                                                <div class="input-holder">
                                                    <input type="password" ng-model="form.data.loginDetails.password" id="password" placeholder="Please enter the Password">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <input type="radio" ng-model="form.data.memberType" value="0" name="radio" id="new-member">
                                        <label for="new-member">New Member (Free)</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <label for="f-name">First Name</label>
                                                <div class="input-holder">
                                                    <input type="text" name="newMember_fName" placeholder="First Name" ng-model="form.data.newMemberDetails.fName">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="l-name">Last name</label>
                                                <div class="input-holder">
                                                    <input type="text" name="newMember_email" placeholder="Last Name" ng-model="form.data.newMemberDetails.lName">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-email">Email</label>
                                                <div class="input-holder">
                                                    <input type="email" name="newMember_email" placeholder="Email" ng-model="form.data.newMemberDetails.email">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-phone">Phone</label>
                                                <div class="input-holder">
                                                    <input type="tel" name="newMember_phone" placeholder="Phone" ng-model="form.data.newMemberDetails.cell">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <label for="new-password">Password</label>
                                                <div class="input-holder">
                                                    <input type="password" name="newMember_password" placeholder="Password" ng-model="form.data.newMemberDetails.password">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <input type="submit" value="SUBMIT PROPERTY">
                            </form>
                        </div>
                        <div class="tips">
                            <strong class="add-pro-heading"><span>tips</span></strong>
                        </div>
                    </div>
                    <div class="thankYou-message" ng-show="propertySaved == true">
                        <h1>Safe <span>successfully</span></h1>
                        <div class="layout">
                            <div class="left"><span class="icon-check"></span></div>
                            <div class="right">
                                <p>Your property details have been received. It will be reviewed by our staff within 24 hours.</p>
                                <p>Property type: <b>Free Listing</b></p>
                                <p>Property status: <b>Pending</b></p>
                            </div>
                        </div>
                        <a href="{{domain}}" class="btn-default">Got it !</a>
                    </div>
                </div>
            </div>
    </div>

    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/jquery-1.11.2.min.js" defer></script>
    <!-- include custom JavaScript -->
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/tabset-plugin.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/helper.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/add-propertyFrom.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/jquery.main.js" defer></script>
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/customSelect.js" defer></script>
    <!-- include custom JavaScript -->
    <script type="text/javascript" src="<?= \App\Libs\Helpers\AppHelper::assetsPath('addPropertyWithAuth', $response['version']) ?>/js/placeholder.js" defer></script>
@endsection
