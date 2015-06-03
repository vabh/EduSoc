<!doctype HTML>
<html>
    <body>
        <?php
        $path = site_url()."/course/new/unit/".$courseID;
        echo form_open($path);
        ?>
        
            Name: <input type="text" name="unitName" id="unitName"/><br/>
            Description: <textarea name="description" id="description"></textarea>
            <input type="submit"/>
        </form>
    </body>
</html>