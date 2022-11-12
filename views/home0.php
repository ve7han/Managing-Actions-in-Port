<?php
$exitNavire = new NavireController();
$navire = $exitNavire->getAllNavire();
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card mt-5">
                <div class="card-header">
                    <h4>Choix du code escale</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="mr-1">
                        <div class="from-group mb-3">
                            <label for="">Navire</label>
                            <div><br>
                            <select name="navire" class="form-control" required>
                                <option value="">Sélectionner</option>
                                <?php foreach ($navire as $newrow) {
                                    echo '<option  value="' . $newrow["code_escale"] . '">' . $newrow["code_escale"] . '</option>';
                                } 
                                if (isset ($_POST['code_esc'])){?><option selected="selected" value="<?php echo $_POST['code_esc'];?>"><?php echo $_POST['code_esc'];?></option> <?php }?>
                            </select>
                            </div><br>
                            <div class="btn-group mb-3">
                            <p>
                                <button formaction="add" class="btn btn-primary">Pilotage<i class="btn-group mr-2"></i></button>
                                <button formaction="add0" class="btn btn-primary">Remorquage<i class="btn-group mr-2"></i></button>
                                <button formaction="add1" class="btn btn-primary">Location Remorque<i class="btn-group mr-2"></i></button>
                                <a class="btn btn-outline-dark" href="<?php echo BASE_URL;?>home"><i class="fa fa-archive" aria-hidden="true"></i></a>
                            </p>
                    </form>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>
</div>
</div>