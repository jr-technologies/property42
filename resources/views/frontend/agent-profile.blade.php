@extends('frontend.frontend')
@section('content')
<div class="agentProfile-page">
    <div class="layout">
        <div class="main-infoHolder">
            <div class="img-holder"><img src="images/agent5.png" width="300" height="300" alt="image description"></div>
            <div class="cap-name">
                <strong class="name">Malik State</strong>
                <p>Our mission is to provide investors with superior returns through an investment in real estate business. Real estate investing can be very profitable, but at the same time it can also be very risky.</p>
                <p>To overcome such risks and make your life easy, please contact us with your needs. We deal in all kinds of commercial and residential properties in lahore.</p>
            </div>
        </div>
        <ul class="contact-links">
            <li><a href="mailto:&#108;&#111;&#108;&#064;&#108;&#111;&#108;&#115;&#105;&#097;&#110;&#046;&#099;&#111;&#109;"><span class="icon-envelope"></span>&#108;&#111;&#108;&#064;&#108;&#111;&#108;&#115;&#105;&#097;&#110;&#046;&#099;&#111;&#109;</a></li>
            <li><a href="tel:0321987654"><span class="icon-phone_iphone"></span><span class="hidden-xs">0321987654</span><span class="show-xs">Call Now</span></a></li>
        </ul>
    </div>
    <div class="cols-holder">
        <div class="col">
            <header>Agent Information</header>
            <div class="caption">
                <div class="profile-pic"><img src="images/profile-pic.png" width="183" height="183" alt="image description"></div>
                <strong class="name">Muneer Ahmad Bhatti</strong>
                <span class="post">Director Marketing</span>
                <p>We are there with you at the start of the process and stay with you until the closing table and beyond. Our company has been selling real estate since 1990. Our journey as Shah Estate Corp in the Rawalpindi / Islamabad real estate market has been a long and exciting one. We have participated in twin city’s modernization and rebuilding process since the 1990's. Throughout our many years of real estate experience we were able to establish ourselves as one of the leading and most respected players in the market. We differentiated ourselves by being able to identify unique market opportunities and transform them into successful investments. Shah Estate Corp will continue to grow its real estate investment and development platform. Our relationship with our investors is based upon trust, transparency and profitability, and will continue to benefit both parties over the long term. That is why we focus heavily on aligning our interests with those of our investors. We are incredibly excited for this journey and truly believe that the best is yet to come for Karachi, Pakistan. We welcome you to M/s Shah Estate Corporation and M/s Shah Builders where “dreams come true”.</p>
            </div>
        </div>
        <div class="col">
            <header>Contact Details</header>
            <div class="caption">
                <strong class="name">Muneer Ahmad Bhatti</strong>
                <span class="agency-name">Shah Estate Corporation</span>
                <span class="contact-num"><a href="tel:92515400336-39"><span class="icon-phone"></span>+92-51-5400336-39</a></span>
                <span class="contact-num"><a href="tel:923018501111"><span class="icon-phone_iphone"></span>+92-3018501111</a></span>
                <address>Office No 74, Sardar Arcade, Spring North Commercial, Bahria Expressway, Phase 7, Bahria Town, Islamabad</address>
            </div>
        </div>
        <div class="col">
            <header>Enquiry through email</header>
            <div class="caption">
                <form class="enquiry-form">
                    <ul>
                        <li>
                            <label for="subject">Subject</label>
                            <div class="input-holder error">
                                <input type="text" id="subject" placeholder="Please Enter Your Subject">
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="name">Name</label>
                            <div class="input-holder">
                                <input type="text" id="name" placeholder="Please enter your Name">
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="email">Email</label>
                            <div class="input-holder">
                                <input type="text" id="email" placeholder="Please enter your Email">
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="phone">Phone</label>
                            <div class="input-holder error">
                                <input type="text" id="phone" placeholder="Please enter your Phone">
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="cell">Cell</label>
                            <div class="input-holder">
                                <input type="tel" id="cell" placeholder="Please enter your Cell">
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="msg">Message</label>
                            <div class="input-holder">
                                <textarea id="msg" placeholder="Please enter your Message"></textarea>
                                <span class="error-text">This is error</span>
                            </div>
                        </li>
                        <li>
                            <label for="captcha">Security code</label>
                            <div class="input-holder add error">
                                <input type="text" id="captcha">
                                <span class="error-text">This is error</span>
                                <img src="images/captcha.jpg" width="130" height="40" alt="captcha" class="captcha">
                            </div>
                        </li>
                        <li><span>Before submiting this form i agree the <a href="#">Terms and condition</a></span></li>
                    </ul>
                    <button type="submit"><span class="icon-envelope"></span>Send email</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection