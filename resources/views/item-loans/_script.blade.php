<script>
$(document).ready(function() {
    // DataTable initialization
    $('#table-1').DataTable({
        "pageLength": 25,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Semua"]],
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        }
    });

    // SOLUSI KUAT: Pastikan modal bisa diakses dan tidak tertutup shadow
    $('#item_loan_create_modal, #item_loan_edit_modal, #excel_menu').on('show.bs.modal', function () {
        var modalId = $(this).attr('id');
        
        // Set z-index sangat tinggi untuk modal
        $(this).css({
            'z-index': '999999',
            'position': 'fixed'
        });
        
        // Set z-index untuk modal dialog
        $(this).find('.modal-dialog').css({
            'z-index': '999999',
            'position': 'relative'
        });
        
        // Set z-index untuk modal content
        $(this).find('.modal-content').css({
            'z-index': '999999',
            'position': 'relative'
        });
        
        // HAPUS SEMUA BACKDROP YANG MENGGANGGU
        setTimeout(function() {
            $('.modal-backdrop').each(function() {
                $(this).hide();
                $(this).css({
                    'display': 'none',
                    'opacity': '0',
                    'pointer-events': 'none',
                    'z-index': '-1'
                });
            });
            
            // Hapus backdrop dari body
            $('body').removeClass('modal-open');
            $('body').css('overflow', 'auto');
        }, 50);
    });
    
    // SOLUSI TAMBAHAN: Hapus backdrop setiap kali modal ditampilkan
    $(document).on('shown.bs.modal', function() {
        $('.modal-backdrop').hide();
        $('.modal-backdrop').css({
            'display': 'none',
            'opacity': '0',
            'pointer-events': 'none',
            'z-index': '-1'
        });
    });



    // Edit modal functionality
    $('.edit-modal').click(function() {
        var id = $(this).data('id');
        
        // Fetch data via AJAX
        $.ajax({
            url: '/peminjaman/' + id + '/edit',
            type: 'GET',
            success: function(data) {
                $('#edit_borrower_name').val(data.borrower_name);
                $('#edit_phone_number').val(data.phone_number);
                $('#edit_item_name').val(data.item_name);
                $('#edit_item_code').val(data.item_code);
                $('#edit_loan_date').val(data.loan_date);
                $('#edit_return_date').val(data.return_date);
                $('#edit_notes').val(data.notes);
                
                // Set form action
                $('#edit_form').attr('action', '/peminjaman/' + id);
            },
            error: function() {
                alert('Terjadi kesalahan saat mengambil data');
            }
        });
    });

    // Delete confirmation
    $('.delete-button').click(function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: "Hapus?",
            text: "Data tidak akan bisa dikembalikan!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    });
});
</script>
