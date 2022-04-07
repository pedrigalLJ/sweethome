<style>
    body
    {
        background: #484a4c21;

    }
    .page-title 
    {
        width: 100%;
        min-height: 250px;
        padding: 4rem 0;
        text-align: left;
        display: flex;
        flex-direction: column;
        align-items: center;
        flex-wrap: wrap;
        justify-content: flex-end;
        background: #f4f5f7;
        background-position: center !important;
        background-size: cover !important;
    }
    [data-overlay]:before 
    {
        position: absolute;
        content: '';
        background: #112848;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }
    [data-overlay] 
    {
        position: relative;
    }
    [data-overlay="5"]:before 
    {
        opacity: 0.5;
    }
    .breadcrumb::after {
        display: block;
        clear: both;
        content: "";
    }
    [data-overlay] *:not(.container):not(.bg-img-holder) 
    {
        z-index: 2;
    }
    ol li 
    {
        list-style: none;
        margin: 5px 0;
    }
    a
    {
        text-decoration: none;
    }
    .text-normal
    {
        color: black;
    }
    .custom-badge
    {
        font-size: 7px;
    }
    .hover-photo 
    {
        height: 300px; 
        overflow: hidden; 
        transition: transform .5s ease;
    }
    .hover-photo:hover 
    {
        transform: scale(1.5);
    }

</style>