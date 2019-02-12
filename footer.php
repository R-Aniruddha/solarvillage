    
  
<!--Footer-->
    <div class="footer">
		
    <?php if(!is_page(array('search', 'home'))) { 
	echo do_shortcode('[INSERT_ELEMENTOR id="860"]');
	echo svlg_partner_logo_slider();}?>       
    </div>
<?php wp_footer(); ?>
<script type="text/javascript">

	
  navigator.serviceWorker.getRegistrations().then(

    function(registrations) {

        for(let registration of registrations) {  
            registration.unregister();

        }

});
	
if ('serviceWorker' in navigator) {
	console.log("Service worker is still there");
//     window.addEventListener('load', () => {
//       navigator.serviceWorker.register('./sw.js')
//         .then(registration => {
//           console.log(`Service Worker registered! Scope: ${registration.scope}`);
//         })
//         .catch(err => {
//           console.log(`Service Worker registration failed: ${err}`);
//         });
//     });
  }
//   
</script>
  </body>
</html>

