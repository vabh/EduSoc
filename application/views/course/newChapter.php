<!doctype HTML>
<html>
    <body>
        <?php
        $path = site_url()."/course/new/chapter/".$u;
        echo form_open($path);
        ?>
        
            Name: <input type="text" name="chapterName" id="chapterName"/><br/>
            Description: <textarea name="description" id="description"></textarea>
            <input type="submit"/>
        </form>
    </body>
</html>