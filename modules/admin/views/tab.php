<div class="row">
    <div class="col-12">
        <ul class="nav nav-tabs w-100 mb-3" id="myTab" role="tablist">
            <?php foreach ($registration_types_menus as $menu): ?>
            <li class="nav-item" role="presentation">
                <a class="nav-link-tab <?php echo $menu['active'] ? 'active' : ''; ?>" 
                    id="<?php echo $menu['id']; ?>-tab" 
                    href="admin/users/<?php echo $menu['id']; ?>" >
                    <?php echo $menu['title']; ?>
                    <span class="number-placeholder"><?php echo $menu['count']; ?></span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<style>
    .nav-link-tab {
      color: grey !important;  /* Green text for all links */
      display: flex;
      justify-content: space-between;  /* Push text and number to opposite ends */
      align-items: center;
      width: 100%;  /* Ensure proper space distribution */
    }
    .nav-link-tab:hover {
      color: green !important;
      text-decoration:  none;  /* Underline the active link */
    }

    .nav-link-tab.active {
      color: green !important;
      font-weight: bold;
      border-bottom: 2px solid green;
    }

    .nav-item {
      margin-right: 15px;  /* Add space between links */
    }

    .number-placeholder {
      color: green;
      /* background-color: white;  Circle background */
      border-color: green;
      border-width: 1px;
      border-style: solid;
      border-radius: 50%;  /* Make it circular */
      width: 24px;  /* Set fixed size for the circle */
      height: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-size: 0.65em;
      margin-left: 10px;  /* Space between text and number circle */
      margin-bottom: 2px;
    }
</style>