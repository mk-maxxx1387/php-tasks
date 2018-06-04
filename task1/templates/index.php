<html>
    <head>
        <title><?=$title;?></title>
    </head>
    <body>
        <style>
        table {
            text-align: center;
        
        }
        </style>
        <? if($message['isError']){ ?>
        <p style='color: red;'><?=$message['message'];?></p>
        <? } else { ?>
        <p style='color: green;'><?=$message['message'];?></p>
        <? } ?>
        <form enctype='multipart/form-data' method='post' action='index.php?action=uploadFile'>
            <input type='file' name='fileUpload' value=''>
            <input type='submit' name='submit' value='submit'>
        </form>

        <? if(!empty($files)){ ?>
            <table border='1' cellpadding='5' frame='void' width='80%' align='center'>
                <tr>
                    <th>#</th>
                    <th>File name</th>
                    <th>Size</th>
                    <th>Command</th>
                </tr>
                <? foreach($files as $key => $file){ ?>
                <tr>
                    <td><?=$key;?></td>
                    <td><?=$file['name'];?></td>
                    <td><?=$file['size'];?> KB</td>
                    <td>
                        <a href='index.php?action=delete&filename=<?=$file['name']?>'>Delete</a>
                    </td>
                </tr>
                <? } ?>
            </table>
        <? } else { ?>
            Files not found
        <? } ?>
    </body> 
</html>
