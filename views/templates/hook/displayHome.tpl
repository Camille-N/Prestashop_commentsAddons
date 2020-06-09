<h3>Témoignages de nos clients</h3>

<div class="rte">
    {foreach from=$advices item=advice}
        <p>
            <strong>Témoignage #{$advice.id_mymod_advice}:</strong>
            {$advice.advice}<br>
        </p><br>
    {/foreach}
</div>

{if $enable_advices eq 1}
<div class="rte">
    <form method="POST" action="" id="advice-form">
        <div class="form-group">
            <label for="advice">Ajouter un témoignage</label>
            <textarea name="advice" id="advice" class="form-control"></textarea>
        </div>

        <div class="submit">
            <button type="submit" name="mymod_pc_submit_advice" class="button btw btn-default button-medium">
                <span>Envoyer
                    <i class="icon-chevron-right right"></i>
                </span>
            </button>
        </div>
    </form>
</div>
{/if}