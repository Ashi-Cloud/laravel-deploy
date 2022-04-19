<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
@livewireScripts

<script>
    jQuery(document).ready(function ($) {
        $('form[data-confirm]').on('submit', function(e){
            let message = $(this).data('confirm');

            if(!confirm(message)){
                e.preventDefault();
                return false;
            }

            return true;
        });
    });
</script>