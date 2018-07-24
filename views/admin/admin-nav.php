<form method="post" id="report-form">
    <div class="btn-toolbar" id="btns-report-group" role="group" aria-label="Admin Nav">
        <button type="submit" id="btn-avg" name="btn-avg" class="btn btn-info btn-sm">Average Rate</button>
        <button type="submit" id="btn-norent" name="btn-norent" class="btn btn-info btn-sm">Never Rented</button>
        <button type="submit" id="btn-freq" name="btn-freq" class="btn btn-info btn-sm">Freq Renters</button>
        <button type="submit" id="btn-2014" name="btn-2014" class="btn btn-info btn-sm">Renters by Year</button>
        <button type="submit" id="btn-rateinc" name="btn-rateinc" class="btn btn-info btn-sm">OV Rate Inc</button>
        <button type="submit" id="btn-earning" name="btn-earning" class="btn btn-info btn-sm">Earning</button>
        <button type="submit" id="btn-payment" name="btn-payment" class="btn btn-info btn-sm">Pmt Types</button>
        <button type="submit" id="btn-pet" name="btn-pet" class="btn btn-info btn-sm">Renter Pet</button>
        <button type="submit" id="btn-rented" name="btn-rented" class="btn btn-info btn-sm">Times Rented</button>
        <?php 
            if($rank === 'super_admin'){
                ?>
                <button type="submit" id="reset-db" class="btn btn-danger btn-sm">RESET DATABASE</button>
                <?php
            }
        ?>
        
    </div>
</form>