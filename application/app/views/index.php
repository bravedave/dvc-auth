<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/  ?>

<ul class="nav flex-column" id="<?= $nav = strings::rand() ?>">
  <li class="nav-item"><a href="<?= strings::url($this->route) ?>"><?= config::label ?></a></li>
  <li class="nav-item"><a class="nav-link" href="<?= strings::url('users') ?>">Users</a></li>
  <li class="nav-item"><a class="nav-link js-settings" href="#">Settings</a></li>

</ul>
<script>
  (_ => {
    const nav = $('#<?= $nav ?>');

    nav.find('.js-settings').on('click', function(e) {
      e.stopPropagation();
      e.preventDefault();

      _.get.modal(_.url('settings'))
        .then( m => m.on('success', e => window.location.href = _.url()));

    });

  })(_brayworth_);
</script>