<div class="container vh-100 d-flex align-items-center justify-content-center">
<form novalidate autocomplete="off" action="./php/user_store.php" method="POST" class="form-ajax">
    <h2>Registrarse</h2>
    <div class="form-rest"></div>
    <div class="mb-3">
    <label for="name" class="form-label" >Name</label>
    <input type="text" class="form-control" id="name" name="name" required>
  </div>

  <div class="mb-3">
    <label for="last-name" class="form-label" >Last Name</label>
    <input type="text" class="form-control" id="last-name" name="last-name" required>
  </div>

  <div class="mb-3">
    <label for="username" class="form-label" >Username</label>
    <input type="text" class="form-control" id="username" name="username" required>
  </div>

  <div class="mb-3">
    
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" required>
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="passsword" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password" required>
  </div>
  <div class="mb-3">
    <label for="passsword_repeat" class="form-label">Repeat Password</label>
    <input type="password" class="form-control" id="password_repeat" name="password_repeat" required>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>