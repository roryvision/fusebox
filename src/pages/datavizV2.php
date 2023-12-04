<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bar Chart</title>

    <link rel='stylesheet' href='../styles/global.css'>
    <link rel='stylesheet' href='../styles/dashboard.css'>
    <script src='../components/Header/HeaderNav.js' type='text/javascript'></script>
</head>
<style>
    .title {
        font-family: 'Visby';
        font-size: 42px;
        font-weight: bolder;
        margins: auto;
        text-align: center;
    }

    .graph {
        font-family: 'Visby';
        font-size: 34px;
        font-weight: bolder;
        margins: auto;
        text-align: center;
        color: #DC1F1F;

    }
    canvas {
        padding-left: 0;
        padding-right: 0;
        margin-left: auto;
        margin-right: auto;
        display: block;
        width: 800px;
    }
</style>
<body>
<!--<div id='container'>-->
<!--    <header-nav></header-nav>-->
<!--    <ul class='flex-btwn' id='select-menu'>-->
<!--        <li class='cursor-pointer selected' value='Roles'>Roles</li>-->
<!--        <li class='cursor-pointer' value='Categories'>Categories</li>-->
<!--    </ul>-->
<div id='container'>
    <header-nav></header-nav>
    <br/>
    <div class="title">
        Data Visualization
    </div>
    <br/><br/>
    <div class="graph">
        Role Frequency in Projects
    </div>
    <br/>


    <?php
    $host = "fseo.webdev.iyaserver.com";
    $userid = "fseo";
    $userpw = "AcadDev_Seo_4772155360";
    $db = "fseo_fusebox";

    $mysql = new mysqli(
        $host,
        $userid,
        $userpw,
        $db
    );

    if($mysql->connect_errno) {
        echo "db connection error : " . $mysql->connect_error;
        exit();
    }

    $data = array();

    $sql1 = "SELECT role_name, COUNT(*) as totalRoles FROM projects_x_roles_x_names GROUP BY role_name";
    $results1 = $mysql->query($sql1);

    if ($results1->num_rows > 0) {
        while ($currentrow = $results1->fetch_assoc()) {
//        echo $currentrow['role_name'] . ":" . $currentrow['totalRoles'];
            $data[] = array(
                'role_name' => $currentrow['role_name'],
                'totalRoles' => $currentrow['totalRoles']
            );
        }
    }

    $data2 = array();

    $sql2 = "SELECT role_type, COUNT(*) as totalTypes FROM projects_x_roles_x_names GROUP BY role_type";
    $results2 = $mysql->query($sql2);

    if ($results2->num_rows > 0) {
        while ($currentrow2 = $results2->fetch_assoc()) {
//        echo $currentrow2['role_type'] . ":" . $currentrow2['totalTypes'];
            $data2[] = array(
                'role_type' => $currentrow2['role_type'],
                'totalTypes' => $currentrow2['totalTypes']
            );
        }
    }


    ?>

    <script>
        var inputdata = <?php echo json_encode($data); ?>;
        console.log('PHP Data:', inputdata);
    </script>

    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>

<script>


    const labels = inputdata.map(item => item.role_name);
    const colors = ['#93D695', '#F8625A', '#FFBF4A', '#1F479B', '#8D43A7'];
    const data = {
        labels: labels,
        datasets: [{
            label: '',
            data: inputdata.map(item => item.totalRoles),
            backgroundColor: colors,
            borderColor: colors,
            borderWidth: 1
        }]
    };

    const maxBarHeight = Math.max(...inputdata.map(item => item.totalRoles)) + 2;

    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    suggestedMax: maxBarHeight,
                },
            },
            plugins: {
                legend: {
                    display: false,
                },
            },
        },
    };

    new Chart(
    document.getElementById('myChart'),
    config
    );
</script>
    <br/><br/>
    <div class="graph">
        Role Category Frequency
    </div>
    <br/>

    <script>
        var inputdata = <?php echo json_encode($data2); ?>;
        console.log('PHP Data:', inputdata);
    </script>

    <div>
        <canvas id="myChart2"></canvas>
    </div>

    <script>


        const labels2 = inputdata.map(item => item.role_type);
        const data2 = {
            labels: labels2,
            datasets: [{
                label: '',
                data: inputdata.map(item => item.totalTypes),
                backgroundColor: colors,
                hoverOffset: 4
            }]
        };

        const config2 = {
            type: 'doughnut',
            data: data2,
        };


        new Chart(
            document.getElementById('myChart2'),
            config2
        );

    </script>