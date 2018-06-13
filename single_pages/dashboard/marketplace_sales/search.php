<?php

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Support\Facade\Url;

$app = Concrete\Core\Support\Facade\Application::getFacadeApplication();

$date = $app->make('helper/form/date_time');

?>

<div class="ccm-dashboard-header-buttons btn-group">
    <?php
    if (!in_array($this->controller->getTask(), ['add'])) {
        ?>
        <a
            class="btn btn-default"
            href="<?php echo $this->action('add') ?>">
            <?php echo t('Add sale'); ?>
        </a>
        <?php
    }
    ?>
</div>

<div class="ccm-dashboard-content-inner">
    <?php
    if (in_array($this->controller->getTask(), ['add'])) {
        ?>
        <form method="post" action="<?php echo $this->action('add') ?>">
            <?php
            echo $token->output('marketplace_sales.add_sale');
            ?>
            <div class="form-group">
                <?php
                echo $form->label('soldAt', 'Sold at');
                echo $date->datetime('soldAt');
                ?>
            </div>

            <div class="form-group">
                <?php
                echo $form->label('email', 'Copy / paste the email');
                echo $form->textarea('email', [
                    'required' => 'required',
                    'style' => 'min-height: 500px',
                ]);
                ?>
            </div>

            <div class="ccm-dashboard-form-actions-wrapper">
                <div class="ccm-dashboard-form-actions">
                    <button class="pull-right btn btn-primary" type="submit"><?php echo t('Save') ?></button>
                </div>
            </div>
        </form>

        <?php
    } else {
        echo 'here we\'ll show an overview of sales';
    }
    ?>
</div>