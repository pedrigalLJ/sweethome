<style>
    body
    {
        background: #484a4c21;

    }
    .carousel-caption h1
    {
        font-family: cursive;
        font-weight: bolder; 
        color: deepskyblue; 
        text-shadow: 4px 4px 3px black; 
        font-size: 40px;
    }
    .carousel-caption p
    {
        font-family: cursive;
        text-shadow: 2px 2px 3px black; 
        font-size: 20px;
    }
    .carousel-inner:after 
    {
        content:"";
        position:absolute;
        top:0;
        bottom:0;
        left:0;
        right:0;
        background:rgba(0,0,0,0.1);
    }
    .prev_img
    {
        width: 100px;
        height: 100px;
    }
    .profile
    {
        width: 50%;
        height: 70%;
    }
    .profileUpdate
    {
        width: 50%;
        height: auto;
    }
    .allprop
    {
        width: 100%;
        height: 250px;
    }
    .text 
    {
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        padding: 16px 32px;
    }
    .image 
    {
      opacity: 1;
      display: block;
      width: 100%;
      height: auto;
      transition: .5s ease;
      backface-visibility: hidden;
    }
    .middle 
    {
      transition: .5s ease;
      opacity: 0;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%)
    }
    .col-md-7:hover .image 
    {
      opacity: 0.3;
    }
    .col-md-7:hover .middle 
    {
      opacity: 1;
    }
    .col-md-7:hover .middle 
    {
      opacity: 1;
    }
    .middle a, a
    {
      text-decoration-line: none;
    }
    .text 
    {
      font-size: 16px;
      padding: 16px 32px;
    }
    .text:hover
    {
      color: rgb(204, 190, 190);
    }
    .hover-photo 
    {
      height: 300px; 
      overflow: hidden; 
      transition: transform .5s ease;
    }
    .hover-photo:hover 
    {
      transform: scale(2.5);
    }
    /* rating */
  	.rating-css .rate-modal
  	{
      color: #dc3545;
      font-size: 30px;
      font-family: sans-serif;
      font-weight: 800;
      text-transform: uppercase;
      padding: 20px;
      
    }
    .rating-css input 
    {
      display: none;
    }
    .checked
    {
      color: #dc3545;

    }
    .rating-css input + label
    {
      padding-top: 20px;
      font-size: 45px;
      text-shadow: 1px 1px 0 #a30303;
      cursor: pointer;
    }
    .rating-css input:checked + label ~ label
    {
      color: #b4afaf;
    }
    .rating-css label:active 
    {
      transform: scale(0.8);
      transition: 0.3s ease;
    }
    .rate-here-css
    {
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
      font-size: 14px;
      font-family: 'Poppins', sans-serif;

    }
    /* .shit
    {
      font-size: 20px;
    } */
  


  /* End of Star Rating */
  .fixed-height
  {
    height: 41.5rem;
  }
  .fixed-aboutMe
  {
    height: 30.4rem;
  }
  .more
  {
    background:lightblue;
    color:navy;
    font-size:13px;
    padding:3px;
    cursor:pointer;
  }
</style>