
(function ($)
        {
            function list(element)
            {
                var that=this;
                var defaults={};
                that.datos=new Array();
                that.element=element;
                
                //that.initialize();
            }

            list.prototype = {

                initialize: function ()
                {
                    var that = this;
                },

                getData:function()
                {
                    var that = this;
                    return that.datos;
                },
                removeData:function()
                {
                    var that = this;
                    that.datos=new Array();
                    return;
                },
                getIds:function()
                {
                    var that = this;
                    var ids=new Array();
                    for(var i=0;i<that.datos.length;i++)
                    {
                        ids.push(that.datos[i][0]);
                        
                    }
                    return ids;
                }
                ,
                addRow: function(_id_,_data_)
                {
                    var that = this;
                    that.datos.push(new Array(_id_,_data_));
                    ver1=that.datos;


                },
                addRow: function(_id_,_data_,_callback_)
                {
                    var that = this;
                    that.addRowCallback=_callback_;
                    that.datos.push(new Array(_id_,_data_));
                     if ($.isFunction(_callback_)) {
                        _callback_.call(that,that.getIndex(_id_),_id_,_data_);
                     }
                    ver1=that.datos;
                },
                addRowOverWrite: function(_id_,_data_)
                {
                    var that = this;
                    that.removeRow(_id_);
                    that.datos.push(new Array(_id_,_data_));
                    ver1=that.datos;

                },
                addRowOverWrite: function(_id_,_data_,_callback_) //agrega una fila y si existe la sobreescribe
                {
                    var that = this;
                    that.removeRow(_id_);
                    that.addRowCallback=_callback_;
                    that.datos.push(new Array(_id_,_data_));
                     if ($.isFunction(_callback_)) {
                        _callback_.call(that,that.getIndex(_id_),_id_,_data_);
                     }
                    ver1=that.datos;
                },
                removeRow: function(_id_)
                {
                    var that = this;
                    var index=that.getIndex(_id_);

                    arrs=new Array();
                    if(index!=-1)
                    {

                        for(var i=0;i<that.datos.length;i++)
                        {
                            if(index!=i)
                            {
                                arrs.push(that.datos[i]);
                            }
                        }
                        that.datos=arrs;
                        pr=that.datos;
                    }
                },
                 removeRow: function(_id_,_callback_)
                {
                    var that = this;
                    var index=that.getIndex(_id_);

                    arrs=new Array();
                    if(index!=-1)
                    {

                        for(var i=0;i<that.datos.length;i++)
                        {
                            if(index!=i)
                            {
                                arrs.push(that.datos[i]);
                            }
                        }
                        that.datos=arrs;
                        pr=that.datos;
                    }
                     if ($.isFunction(_callback_)) {
                        _callback_.call(that,_id_);
                     }
                },
                getIndex: function(_id_){
                    var that = this;
                    value=-1;
                    for(var i=0;i<that.datos.length;i++)
                    {
                        if(_id_==that.datos[i][0])
                        {
                            value=i;
                            break;
                        }
                    }
                    return value;
                },
                getColumn: function(_id_,_column_)
                {
                    var that=this;
                    var value=that.private_getColumn(_id_,_column_);
                    if(value[0]!=false)
                    {
                        return value[4];
                    }else
                    {
                        return -1;
                    }
                },
                private_getColumn: function(_id_,_column_){
                    var that = this;
                    var _index_=that.getIndex(_id_);
                    if(_index_==-1)
                    {
                        return new Array(false);
                    }
                    var arr=that.datos[_index_][1];
                    for(var i=0;i<arr.length;i++)
                    {
                        if(arr[i][0]==_column_)
                        {

                            return new Array(true,_index_,1,i,arr[i][1]);
                        }
                    }

                    return new Array(false);
                },
                setColumn: function(_id_,_column_,_value_)
                {
                    var that=this;
                    var inf=that.private_getColumn(_id_,_column_);
                    if(inf[0]!=false)
                    {
                        that.datos[inf[1]][inf[2]][inf[3]][1]=_value_;
                    }
                    ver1=that.datos;
                },
                
                setColumn: function(_id_,_column_,_value_,_callback_)
                {
                    var that=this;
                    var inf=that.private_getColumn(_id_,_column_);
                    if(inf[0]!=false)
                    {
                        that.datos[inf[1]][inf[2]][inf[3]][1]=_value_;
                    }
                    if ($.isFunction(_callback_)) {
                        _callback_.call(that,inf[1],_id_,_column_,_value_); //(index,id,column,value)
                    }
                    ver1=that.datos;
                }

            };


        $.fn.extend({
            list:function()
            {

                var element=$(this);
                var dataKey = 'list';

                if(!element.data(dataKey))
                {
                    element.data(dataKey,new list(element));
                    return element.data(dataKey);
                }else
                {
                    return element.data(dataKey);
                }

            }
        });

        })(jQuery);

//ejemplo
        /*
            $("#tal").list().addRow("15",new Array(["cln1",["bar"]],["cln2",["par"]],["cln3",["par2"]]));
        $("#tal").list().addRow("18",new Array(["cln1",["cat"]],["cln2",["nio"]],["cln3",["par2"]]));
        $("#tal").list().addRow("21",new Array(["cln1",["ati"]],["cln2",["almueda"]],["cln3",["par2"]]));
        $("#tal").list().addRow("24",new Array(["cln1",["mouese"]],["cln2",["nani"]],["cln3",["par2"]]));
        $("#tal").list().removeRow(21);
        $("#tal").list().setColumn(18, "cln3", new Array("nuevo"));


        $("#tal2").list().addRow("15",new Array(["campo1",["bar"]],["cln2",["par"]],["cln3",["par2"]]));
        $("#tal2").list().addRow("18",new Array(["campo1",["cat"]],["cln2",["nio"]],["cln3",["par2"]]));

        alert($("#tal").list().getColumn("24", "cln2"));
        alert($("#tal2").list().getColumn("15", "campo1")); */