<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>page</title>
</head>


<body>
    <?php
    $data = array();
    $data[] = 'Hồng Nhung';
    $data[] = 'Bạch Hiếu';
    $data[] = 'Đào Tuấn';
    $data[] = 'Đinh Hoàn My';
    $data[] = 'Đoàn Đức Hải';
    $data[] = 'Đoàn Huy Hoàng';
    $data[] = 'Đỗ Minh Tú';
    $data[] = 'Đức Tiến';
    $data[] = 'Hồ Thái';
    $data[] = 'Huyền Trang';
    $data[] = 'Lê Minh Hiếu';
    $data[] = 'Lê Văn Anh';
    $data[] = 'Nguyenbahao';
    $data[] = 'Phạm Đức Tùng';
    $data[] = 'Phước';
    $data[] = 'Thành Công';
    $data[] = 'Trần Đình Phúc';
    $data[] = 'Trần Thị Hương Ly';
    $data[] = 'Nguyễn Chí Nghĩa';
    #
    require_once('pagination.php');
    $record_per_page = 5;
    $current_page = isset($_GET['page']) && intval($_GET['page']) ? intval($_GET['page']) : 1;
    $link = '/demo/php-pagination-array';

    // Khởi tạo đối tượng
    $pagination = new paginationArray($data, $current_page, $record_per_page, array('a' => 1));
    // Set Prev và Last
    $pagination->setShowFirstAndLast(TRUE);
    $lstItems = $pagination->getResults();
    $pageHTML = $pagination->getLinks($link);
    ?>

    <table class="tbl-grid" cellpadding="0" cellspacing="0" awidth="100%">
        <thead>
            <tr>
                <td align="center" class="gridheader">STT</td>
                <td class="gridheader">Tiêu đề</td>
            </tr>
        </thead>
        <tbody>
            <?php for ($i = 0; $i < count($lstItems); $i++) { ?>
                <tr>
                    <td align="center"><?php echo $i; ?></td>
                    <td><?php echo $lstItems[$i]; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php echo $pageHTML; ?>
    </div>

</body>

</html>