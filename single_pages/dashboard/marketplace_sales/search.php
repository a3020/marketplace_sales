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
    if (in_array($this->controller->getTask(), ['add', 'parse'])) {
        ?>
        <form method="post" action="<?php echo $this->action('parse') ?>">
            <?php
            echo $token->output('marketplace_sales.add_sale');
            ?>
            <div class="form-group">
                <?php
                echo $form->label('soldAt', 'Sold at');
                echo $date->datetime('soldAt', date('Y-m-d'));
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
                    <a class="btn btn-default" href="<?php echo Url::to('/dashboard/marketplace_sales/search'); ?>"><?php echo t('Cancel') ?></a>
                    <button class="pull-right btn btn-primary" type="submit"><?php echo t('Save') ?></button>
                </div>
            </div>
        </form>

        <?php
    } else {
        ?>

        <div class="statistics">
            <table class="table">
                <tbody>
                    <tr>
                        <td><?php echo t('Total revenue'); ?></td>
                        <td>$<?php echo number_format($totalRevenue, 2) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo t('Total this year'); ?></td>
                        <td>$<?php echo number_format($totalRevenueYear, 2) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo t('Total in past 30 days'); ?></td>
                        <td>$<?php echo number_format($totalRevenueMonth, 2) ?></td>
                    </tr>
                    <tr>
                        <td><?php echo t('Total sales'); ?></td>
                        <td><?php echo $totalSales ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table class="table table-striped table-bordered" id="tbl-sales">
            <thead>
                <tr>
                    <th><?php echo t('Order number'); ?></th>
                    <th style="width: 220px"><?php echo t('Sale name') ?></th>
                    <th style="width: 135px"><?php echo t('Add-on handle') ?></th>
                    <th style="width: 65px"><?php echo t('Username') ?></th>
                    <th style="width: 65px"><?php echo t('Date') ?></th>
                    <th style="width: 135px"><?php echo t('Amount') ?></th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
        <?php
    }
    ?>
</div>


<script>
$(document).ready(function() {
    $('#tbl-sales').DataTable({
        ajax: '<?php echo Url::to('/ccm/system/marketplace_sales/sales'); ?>',
        lengthMenu: [[20, 50, 100], [20, 50, 100]],
        columns: [
            {
                data: "order_number"
            },
            {
                data: "package_name"
            },
            {
                data: "package_handle"
            },
            {
                data: function(row, type, val) {
                    return '<a target="_blank" href="https://www.concrete5.org/profile/-/' + row.user_id + '">' + row.username + '</a>';
                }
            },
            {
                data: "sold_at"
            },
            {
                data: "amount"
            }
        ],
        order: [[4, "desc"]]
    });
})
</script>

