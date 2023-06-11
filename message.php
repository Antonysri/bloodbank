<style>
    .alert {
        height: 50px;
        width: 600px;
        margin-top: 30px;
        
    }
</style>


<?php if(isset($_GET['msg'])): ?>
    <div class="d-flex justify-content-center">
    <div class="alert alert-success alert-dismissible fade show mb-3 text-center" id="message" role="alert">
    <?php echo $_GET['msg']; ?>
    </div>
    </div>
    
     <script>
        setTimeout(function(){
            document.getElementById('message').style.display='none';
        },3000)  
    </script> 

<?php endif; ?>
<?php if(isset($_GET['error'])): ?>
    <div class="d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissible fade show mb-3 text-center" id="message" role="alert">
    <?php echo $_GET['error']; ?>
    
    </div>
    </div>
      <script>
        setTimeout(function(){
            document.getElementById('message').style.display='none';
        },3000)  
    </script> 


<?php endif; ?>


