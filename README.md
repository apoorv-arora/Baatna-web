Assignment 1
============
- [x] Validate and store pre-signup emails.
- [x] Send a welcome email to above pre-signup emails as soon as they pre-signup.
- [x] Welcome email will have a link to our referral page in the website.
- [x] You will need to design the referral page and create a referral link for the email.
- [x] From the referral page, user can add multiple email address in the page and refer people. 
- [x] Include timestamp (UTC)
- [x] Contact us form not coming up.
- [x] Inserting the same email address should have a different error message.
- [x] Images are not loading up.
- [x] Referrals coming soon?
- [x] For each signup, check if the entered email was referred by anyone, if so, mark the referrer so that we can provide him\her with our merchandise.
- [x] Q : What is token?

      A : It is cryptic UID used to generate referral URL
- [x] Q : Why the name is required in users table? 

      A : In future we may get such values from FB/TW/G+ APIs
- [x] Q : How will you going to give points to the user who has just joined with somebodies referral? 

      A : __referrals__ table has uid -> email, so a simple SQL query can do it

          `SELECT count(email) FROM users WHERE email IN (SELECT email FROM referrals WHERE uid = ?)`
- [x] Website parallax is gone. TBH the frontend code was scattering here and there, I had reorganized it a bit and I probably messed up doing that.
- [x] Not receiving welcome mails. Hence could not check with referral system. I am using PHP's mail function, should work on a SMTP server (not on local unless configured)
- [ ] Merge with poras_baatna and push.
