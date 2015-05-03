<link href="../css/admin.css" rel="stylesheet" type="text/css">
        
        <!-- Add Awesomefont -->
        <link href="../css/font-awesome.css" rel="stylesheet" type="text/css">
        
        <!-- Add jQuery library -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>

        <!-- Add fancyBox -->
        <link rel="stylesheet" href="../fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

        <!-- Optionally add helpers - button, thumbnail and/or media -->
        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

        <link rel="stylesheet" href="../fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
        <script type="text/javascript" src="../fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $(".fancybox").fancybox();
            });
            
            $(document).ready(function() {
                $(".various").fancybox({

                    fitToView	: false,
                    width		: '70%',
                    height		: '70%',
                    autoSize	: false,
                    closeClick	: false,
                    openEffect	: 'fade',
                    closeEffect	: 'fade',
                    afterClose  : function() { document.location.reload(true) }
                });
            });
            
        </script>
