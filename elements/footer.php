
</main><!-- /.container -->
<div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-md-4">
            compteur de vue : <?= $compteur?></br>
            compteur de vue journalier: <?= $comptJour ?>
        </div>
        <div class="col-md-4">
            <?php if(!strpos($_SERVER["SCRIPT_NAME"],"newsletter")){ ?>
                <form action="newsletter.php" method="post" class="form-inline" >
                    <div class="form-group">
                        <input type="text" placeholder="rentrez votre mail" name="email"  required class="form-control"/>
                    </div>
                    <button type="submit" class="btn btn-secondary">Enregistrer</button>
                </form>
            <?php } ?>
        </div>
        <div class="col-md-4">
            <h5>Navigation</h5>
            <ul class="list-unstyled text-small">
                <?php echo nav_menu();?>
            </ul>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</html>

