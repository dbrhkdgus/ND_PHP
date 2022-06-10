<style>
    .inventory_search_from{
        margin-top: 2%;
    }
    .inner-form{
        display: flex;
        align-items: center;
        flex-direction: row;
        justify-content: flex-end;
    }
    .inner-form > .select-wrap{
        width: 10%;
    }
    .select-wrap select, .input-wrap input{
        width: 95%;
    }

    .inner-form > .input-wrap{
        width: 20%;
    }
    
</style>


<div class="inventory_search_from">
    <form>
        <div class="inner-form">
            <div class="input-field select-wrap">
                <div class="icon-wrap">

                </div>
                <select name="choices-single-defaul" data-trigger>
                    <option placeholder="">카테고리</option>
                    <option>3 Adults</option>
                    <option>4 Adults</option>
                    <option>5 Adults</option>
                </select>
            </div>
            <div class="input-field select-wrap">
                <div class="icon-wrap">

                </div>
                <select name="choices-single-defaul" data-trigger>
                    <option placeholder="">제품명</option>
                    <option>3 Adults</option>
                    <option>4 Adults</option>
                    <option>5 Adults</option>
                </select>
            </div>
            <div class="input-field input-wrap">
                <div class="icon-wrap">

                </div>
                <input class="datepicker" id="return" type="text" placeholder="30 Aug 2018">
            </div>
            <div class="input-field fifth-wrap">
                <button class="btn-search" type="button">SEARCH</button>
            </div>
        </div>
    </form>
</div>