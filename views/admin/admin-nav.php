<form method="post">
    <div class="btn-toolbar" id="btns-report-group" role="group" aria-label="Admin Nav">
        <button type="submit" id="btn-avg" name="btn-avg" class="btn btn-info">Average Rate</button>
        <button type="submit" id="btn-norent" name="btn-norent" class="btn btn-info">No Rent</button>
        <button type="submit" class="btn btn-info">view3</button>
        <button type="submit" class="btn btn-info">view4</button>
        <button type="submit" class="btn btn-info">view5</button>
        <button type="submit" class="btn btn-info">view6</button>
        <button type="submit" class="btn btn-info">view7</button>
        <button type="submit" class="btn btn-info">view8</button>
        <button type="submit" class="btn btn-info">view9</button>
        <?php 
            if($rank === 'super_admin'){
                ?>
                <button type="submit" id="reset-db" class="btn btn-danger">RESET DATABASE</button>
                <?php
            }
        ?>
        
    </div>
</form>