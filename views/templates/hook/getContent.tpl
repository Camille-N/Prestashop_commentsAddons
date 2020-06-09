{if isset($confirmation)}
<div class="alert alert-success">
La configuration a bien été mise à jour</div>
{/if}

<form method="POST" action="" class="defaultForm form-horizontal">

<div class="panel">

    <div class="panel-heading">
        <i class="icon-cogs"></i>
        La configuration de mon module
    </div>

    <div class="form-wrapper">
        <div class="form-group">
            <label class="control-label col-lg-3">Activer les témoignages : </label>
            <div class="col-lg-9">
                <img src="../img/admin/enabled.gif" alt="enable icon" />
                <input type="radio" id="enable_advices_1" name="enable_advices" value="1" {if $enable_advices eq '1'}checked{/if}/>
                <label class="t" for="enable_advices_1" >Oui</label>

                <img src="../img/admin/disabled.gif" alt="disable icon" />
                <input type="radio" id="enable_advices_0" name="enable_advices" value="0" {if $enable_advices ne '1'}checked{/if}/>
                <label class="t" for="enable_advices_0">Non</label>
            </div>
        </div>        
    </div>

    <div class="panel-footer">
        <button class="btn btn-default pull-right" name="submit_mysiteadvice_form" value="1" type="submit">
            <i class="process-icon-save"></i>
            Enregistrer
        </button>
    </div>

</div>
</form>