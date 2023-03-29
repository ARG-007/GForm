<style>
body{
    background-color: antiquewhite;
    text-align: center;
    font-family: sans-serif;
    font-weight: bold;
}
.center-table {
    width:80%;
    margin: 1em auto;
    border-collapse: collapse;
    box-shadow: 2px;
}

td,th{
    border: 2px solid black;
    text-align: center;
}
.mongo{
    background-color: aliceblue;
    border-spacing: 10px;
    border: 2px solid black;
    border-radius: 10px;
    border-collapse: separate;
}
.mongo th{
    width: 100%;
    border:0px;
    border-radius: 10px;
    height: 100%;
}

.mongo td{
    box-shadow: 1px 1px gray;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 10px;
    padding-left: 40px;
    text-align: left;
}

.mongo td>:first-child{
    color: brown;
}


thead th{
    position:sticky;
}

</style>
<?php
require_once "../assets/serverConfig.php";
?>
<h2 style="font-size:2rem">SERVER STATUS</h2>
<h3 style="font-size:1.5rem">MySQL</h3>
<table class="center-table">
    <colgroup>
        <col style="width:30%;background-color:cadetblue;">
    </colgroup>
    <?php
    echo "
    <tr>
        <td>Host</td>
        <td>{$host}</td>
    </tr>
    <tr>
        <td>Port</td>
        <td>{$port}</td>
    </tr>
    <tr>
        <td>User</td>
        <td>{$user}</td>
    </tr>
    <tr>
        <td>Password</td>
        <td>{$password}</td>
    </tr>
    <tr>
        <td>Database</td>
        <td>{$dbname}</td>
    </tr>
    <tr>
        <td>Table</td>
        <td>{$table}</td>
    </tr> 
    "
    ?>
</table>

<table class="center-table">
    <colgroup>
        <col style="width:20%">
        <col style="width:40%">
        <col style="width:40%">
    </colgroup>
    <thead style="background-color:aquamarine">
        <tr style="background-color:darkseagreen"><td colspan="3">Entries</td></tr>
        <th>pid</th>
        <th>mail</th>
        <th>password</th>
    </thead>
    <tbody>
        <?php
        $entries = $sql->query("SELECT * FROM {$table}");
        $entryCount = $entries->num_rows;
        if($entryCount)
            while($entry=$entries->fetch_assoc()){
                echo 
                "<tr>
                    <td>{$entry['pid']}</td>
                    <td>{$entry['mail']}</td>
                    <td>{$entry['password']}</td>
                </tr>";
            }
        else
            echo "<tr><td colspan='3'>No Entries In MySQL DB</td></tr>";
        echo "<td colspan='3' style='background-color:aquamarine'>Entries: {$entryCount}</td>"
        ?>
    </tbody>
</table>

<h3 style="font-size:1.5rem">MongoDB</h3>
<table class="center-table">
    <colgroup>
        <col style="width:30%;background-color:cadetblue;">
    </colgroup>
    <?php
    echo "
    <tr>
        <td>Host</td>
        <td>{$mongoIP}</td>
    </tr>
    <tr>
        <td>Port</td>
        <td>{$mongoPort}</td>
    </tr>
    <tr>
        <td>Full Qualified Name</td>
        <td>mongodb://{$mongoIP}:{$mongoPort}</td>
    </tr>
    <tr>
        <td>Database</td>
        <td>GFormDB</td>
    </tr>
    <tr>
        <td>Collection</td>
        <td>userProfiles</td>
    </tr> 
    "
    ?>
</table>

<h4>DOCUMENTS</h4>
<table class="center-table mongo">
    <tbody>
    <?php
    $cursor = $userProfile->find();
    // $cursor->setTypeMap([
    //     'array' => 'array',
    //     'document' => 'array',
    //     'root' => 'array'
    // ]);
    $cursor = $cursor->toArray();
    if(count($cursor))
        foreach($cursor as $document){
            echo "<tr><td>";
            foreach($document as $entry=>$value){
                echo "<div>{$entry} : {$value}</div>";
            }   
            echo "</td></tr>";
        }
    else
        echo "<tr><td style='text-align:center;'><div>NO DOCUMENTS ARE STORED IN MONGODB</div></td></tr>";
    ?>
    </tbody>
</table>

<h3>REDIS<h3>

<table class="center-table">
    <colgroup>
        <col style="width:30%;background-color:cadetblue;">
    </colgroup>
    <?php
    echo "
    <tr>
        <td>Host</td>
        <td>{$redisIP}</td>
    </tr>
    <tr>
        <td>Port</td>
        <td>{$redisPort}</td>
    </tr>
    <tr>
        <td>Key Cache Invalidation (secs)</td>
        <td>{$redisKeyExpire}</td>
    </tr>
    "
    ?>
</table>

<table class="center-table">
<colgroup>
        <col style="width:33%">
        <col style="width:33%">
        <col style="width:33%">
    </colgroup>
    <thead style="background-color:aquamarine">
        <tr style="background-color:darkseagreen"><td colspan="3">Entries</td></tr>
        <th>Key</th>
        <th>Value</th>
        <th>TTL (secs)</th>
    </thead>
    <tbody>
        <?php
        $keys=$redis->keys('*');
        if(count($keys))
            foreach($keys as $key){
                echo "
                <tr>
                <td>{$key}</td>
                <td>{$redis->get($key)}</td>
                <td>{$redis->ttl($key)}</td>
                </tr>
                ";
            }
        else
            echo "<tr><td colspan='3'>No Keys Are Stored In Redis</td></tr>";
        ?>
    </tbody>
</table>