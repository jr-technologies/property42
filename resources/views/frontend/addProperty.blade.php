@extends('frontend.frontend')
@section('content')
    <div id="content">
        <div class="container">
            <div class="page-holder">
                <div class="addPropertyForm-page">
                    <div class="addPropertyFormContainer" ng-controller="AddPropertyController" ng-init="initialize()">
                        <form class="property-add" ng-submit="submitProperty()">
                            <section class="basics-block">
                                <div class="errors">
                                    <ul>
                                        <li data-ng-repeat="error in errors">Owner is invalid</li>
                                    </ul>
                                </div>
                                <strong class="form-heading"><span>Property Type and Location</span></strong>
                                <div class="layout">
                                    <span class="title">purpose:</span>
                                    <div class="input-holder">
                                        <ul class="radio-holder">
                                            <li>
                                                <label for="sale">
                                                    <input type="radio" ng-model="form.data.propertyPurpose" value="1" name="propertyPurpose" id="sale">
                                                    <span class="fake-label">For Sale</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="rent">
                                                    <input type="radio" ng-model="form.data.propertyPurpose" value="2" name="propertyPurpose" id="rent">
                                                    <span class="fake-label">For Rent</span>
                                                </label>
                                            </li>
                                            <li class="error-text">Oh ! this is error</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="layout">
                                    <span class="title">Property Type:</span>
                                    <div class="input-holder">
                                        <ul class="radio-holder">
                                            <li>
                                                <label for="homes" class="hasChild">
                                                    <input type="radio" name="propertyType" value="1" id="homes">
                                                    <span class="fake-label">homes</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="plot" class="hasChild">
                                                    <input type="radio" name="propertyType" value="1" id="plot">
                                                    <span class="fake-label">plot</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label for="commercial" class="hasChild">
                                                    <input type="radio" name="propertyType" value="1" id="commercial">
                                                    <span class="fake-label">commercial</span>
                                                </label>
                                            </li>
                                            <li class="error-text">Oh ! this is error</li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="tab1">
                                                <ul class="radio-holder">
                                                    <li>
                                                        <label for="house" class="withCheck">
                                                            <input type="radio" name="propertySubType" ng-model="$parent.form.data.propertySubType" id="house" value="house">
                                                            <span class="fake-radio"></span>
                                                            <span class="fake-label">house</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="flat" class="withCheck">
                                                            <input type="radio" name="propertySubType" ng-model="$parent.form.data.propertySubType" id="flat" value="flat">
                                                            <span class="fake-radio"></span>
                                                            <span class="fake-label">flat</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label for="ploot" class="withCheck">
                                                            <input type="radio" name="propertySubType" ng-model="$parent.form.data.propertySubType" id="ploot" value="ploot">
                                                            <span class="fake-radio"></span>
                                                            <span class="fake-label">ploot</span>
                                                        </label>
                                                    </li>
                                                    <li class="error-text">Oh ! this is error</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">Society:</span>
                                        <div class="input-holder">
                                            <select class="js-example-basic-single">
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">Block:</span>
                                        <div class="input-holder">
                                            <select class="js-example-basic-single">
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                                <option>1</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <strong class="form-heading"><span>Property &amp; Area</span></strong>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">Price:</span>
                                        <div class="input-holder">
                                            <input type="number" class="PriceField" name="price" ng-model="form.data.price" placeholder="Please enter your price">
                                            <span class="error-text">This is error</span>
                                            <span class="calculatedPrice">Please enter the price</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">Property Title:</span>
                                        <div class="input-holder">
                                            <input type="text" name="propertyTitle" ng-model="form.data.propertyTitle" placeholder="Please enter property title">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">Land Area:</span>
                                        <div class="input-holder">
                                            <input type="number" step="any" ng-model="form.data.landArea" placeholder="Please enter land area">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">Unit:</span>
                                        <div class="input-holder">
                                            <select name="land_unit" ng-model="form.data.landUnit">
                                                <option value="1" selected disabled>Select Unit</option>
                                                <option value="2">Squar Feet</option>
                                                <option value="3">Squar Yards</option>
                                            </select>
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder add">
                                        <span class="title less-width">Description:</span>
                                        <div class="input-holder add">
                                            <textarea name="propertyDescription" ng-model="form.data.propertyDescription" placeholder="Please enter description"></textarea>
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">Number of store Rooms:</span>
                                        <div class="input-holder">
                                            <input type="checkbox">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">Bedrooms:</span>
                                        <div class="input-holder">
                                            <input type="number" placeholder="Number of bedrooms">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <div class="input-holder"><a class="feature-blockOpener">see extra feature</a></div>
                                    </div>
                                </div>
                            </section>
                            <section class="feature-block">
                                <strong class="form-heading"><span>extra features</span></strong>
                                <div class="holder">
                                    <div class="features-section-holder">
                                        <span class="tag">Main Features</span>
                                        <ul class="feature-list">
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <select>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="radio">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="checkbox">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="features-section-holder">
                                        <span class="tag">Main Features</span>
                                        <ul class="feature-list">
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <select>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="radio">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="checkbox">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="features-section-holder">
                                        <span class="tag">Main Features</span>
                                        <ul class="feature-list">
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <select>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="radio">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="checkbox">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="features-section-holder">
                                        <span class="tag">Main Features</span>
                                        <ul class="feature-list">
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <select>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="radio">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="checkbox">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="features-section-holder">
                                        <span class="tag">Main Features</span>
                                        <ul class="feature-list">
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <select>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                        <option>1</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="radio">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="checkbox">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                            <li>
                                                <label>Bedrooms:</label>
                                                <div class="input-holder">
                                                    <input type="number" placeholder="Number of bedrooms">
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <section class="attactment-block">
                                <strong class="form-heading"><span>attactments</span></strong>
                                <ul class="image-uploading-area">
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.mainFile.file" onchange="previewAddPropertyImg(this , '.img-thumb1')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb1" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(0)"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.mainFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.twoFile.file" onchange="previewAddPropertyImg(this , '.img-thumb2')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb2" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(1)"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.twoFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ngf-select ng-model="form.data.files.threeFile.file" onchange="previewAddPropertyImg(this , '.img-thumb3')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb3" alt="image Description">
                                                <span class="propertyDocumentCloseBtn" ng-click="cancelFile(2)"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.threeFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ng-model="form.data.files.fourFile.file" onchange="previewAddPropertyImg(this , '.img-thumb4')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb4" alt="image Description">
                                                <span class="propertyDocumentCloseBtn"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.fourFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ng-model="form.data.files.fiveFile.file" onchange="previewAddPropertyImg(this , '.img-thumb5')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb5" alt="image Description">
                                                <span class="propertyDocumentCloseBtn"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.fiveFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                    <li>
                                        <div class="file-uploader">
                                            <input type="file" ng-model="form.data.files.sixFile.file" onchange="previewAddPropertyImg(this , '.img-thumb6')" class="upload-img">
                                            <div class="image-holder">
                                                <img src="#" class="img-thumb6" alt="image Description">
                                                <span class="propertyDocumentCloseBtn"><span class="icon-trash"></span></span>
                                            </div>
                                        </div>
                                        <input type="text" ng-model="form.data.files.sixFile.title" class="picture-name" placeholder="Title">
                                        <span class="error-text">This is error</span>
                                    </li>
                                </ul>
                            </section>
                            <section class="contact-information">
                                <strong class="form-heading"><span>Contact info</span></strong>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">owner:</span>
                                        <div class="input-holder">
                                            <select name="owner" ng-model="form.data.owner">
                                                <option value="1">Noman Tufail</option>
                                            </select>
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">contact person:</span>
                                        <div class="input-holder">
                                            <input type="text" name="contact_person" ng-model="form.data.contactPerson" placeholder="Please Enter your contact person">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">Phone:</span>
                                        <div class="input-holder">
                                            <input type="text" name="phone" ng-model="form.data.phone" placeholder="Please enter phone number">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">Cell:</span>
                                        <div class="input-holder">
                                            <input type="text" name="cell" ng-model="form.data.cell" placeholder="Please enter cell number">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="layout add">
                                    <div class="layout-holder">
                                        <span class="title">fax:</span>
                                        <div class="input-holder">
                                            <input type="text" name="title" ng-model="form.data.fax" placeholder="please enter Fax">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                    <div class="layout-holder">
                                        <span class="title">email:</span>
                                        <div class="input-holder">
                                            <input type="email" name="email" ng-model="form.data.email" placeholder="Please enter your email">
                                            <span class="error-text">This is error</span>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section class="userRegLogin">
                                <strong class="form-heading"><span>Details</span></strong>
                                <ul class="enterUserType">
                                    <li>
                                        <input type="radio" name="radio" id="existing-member" checked>
                                        <label for="existing-member">Existing Member</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <span class="title">Username:</span>
                                                <div class="input-holder">
                                                    <input type="text" name="login-username" placeholder="User Name">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <span class="title">Password:</span>
                                                <div class="input-holder">
                                                    <input type="password" name="login-password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <input type="radio" name="radio" id="new-member">
                                        <label for="new-member">New Member (Free)</label>
                                        <div class="slide">
                                            <div class="layout">
                                                <span class="title">Full name:</span>
                                                <div class="input-holder">
                                                    <input type="text" name="newMember-name" placeholder="Full Name">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <span class="title">Email:</span>
                                                <div class="input-holder">
                                                    <input type="email" name="newMember-email" placeholder="Email">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <span class="title">Phone:</span>
                                                <div class="input-holder">
                                                    <input type="tel" name="newMember-phone" placeholder="Phone">
                                                </div>
                                            </div>
                                            <div class="layout">
                                                <span class="title">Password:</span>
                                                <div class="input-holder">
                                                    <input type="password" name="login-password" placeholder="Password">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>

                            </section>
                            <button type="submit"><span class="icon-arrows"></span>Save Property</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection