<div class="container">
  <div class="wrapper-login">
    <h2>Sign in</h2>
    
    <form action="<?= BASEURL; ?>/users/login" method="POST">
      <div class="form-control">
          <label for="username">Username</label>
          <input type="text" name="username" id="username" placeholder="Username">
          <span class="invalidFeedback">
            <?= $data['usernameError']; ?>
          </span>
      </div>

      <div class="form-control">
          <label for="password">password</label>
          <input type="password" name="password" id="password" placeholder="password" maxlength="8">
          <span class="invalidFeedback">
            <?= $data['passwordError']; ?>
          </span>
      </div>
      <button type="submit" id="submit" value="submit" name="submit">Submit</button>
      <p class="option">Not Register yet ? <a href="<?= BASEURL; ?>/users/register">Create Account</a></p>
    </form>
  </div>
</div>