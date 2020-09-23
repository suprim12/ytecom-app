NONCE_FIELD_PH <!-- FOR NONCE -->
<div id="regformEror" class="alert">Username Already Taken</div>
<form class="form" id="reg-form">
    <div class="form-group">
    <label>Choose Username</label>
    <input type="text" id="reg-username" placeholder="Username" />
    <span class="form-error--feedback"></span>
    </div>
    <div class="form-group">
    <label>Your Email</label>
    <input type="email" id="reg-email" placeholder="Email" />
    <span class="form-error--feedback"></span>
    </div>
    <div class="form-group">
    <label>Choose Password</label>
    <input type="password" id="reg-password" placeholder="Password" />
    <span class="form-error--feedback"></span>
    </div>
    <div class="form-group">
    <label>Confirm Password</label>
    <input
        type="password"
        id="confirm_password"
        placeholder="Confirm Password"
    />
    <span class="form-error--feedback"></span>
    </div>
    <button type="submit" class="form-btn">Register</button>
</form>