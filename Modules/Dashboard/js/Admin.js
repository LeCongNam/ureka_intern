import React, { useState } from 'react'
import { Layout, Menu } from 'antd';
const { Header, Content, Footer, Sider } = Layout;
import { Switch, Route, useHistory } from "react-router-dom";
import AddGroupUser from './AddGroupUser';
import AddUser from './AddUser';
import ShowUser from './ShowUser';
import AddProduct from './AddProduct';
import ShowProduct from './ShowProduct';
import EditProduct from './EditProduct';
import EditUser from './EditUser';
import Home from './Home'
import Sidebar from "./Layout/Sidebar";



 function Admin() {
     const history = useHistory()
    const [collapsed, setSollapsed] = useState(false)

    const items1 = ['Admin', 'logout'].map((item, index, origin) => ({
        key:`${Math.random()}`,
        label: `${item.toUpperCase()}`,
        onClick:()=>{
            if(origin[index] == 'logout'){
                let path = '/api/'+origin[index]
                history.push(path)
                window.location.reload()
            }
        }
    }));


    const onCollapse = () => {
        setSollapsed((isColl) => {
            return isColl = !isColl
        }
        )
    };

    return (
        <Layout style={{ minHeight: '100vh' }}>
            <Sider collapsible collapsed={collapsed} onCollapse={onCollapse}>
               <Sidebar/>
            </Sider>
            <Layout className="site-layout">
                <Header className="site-layout-background" style={{ padding: 0 }}>
                    <Menu theme="dark" mode="horizontal" style={{ justifyContent: 'flex-end' }} defaultSelectedKeys={['2']} items={items1} />
                </Header>
                <Content style={{ margin: '0 16px' }} >
                    <div className="site-layout-background" style={{ padding: 24, minHeight: 360, }}>
                       {/* Start Content */}
                            <Switch>
                                <Route path='/admin/add-group' component={AddGroupUser}/>
                                <Route path='/admin/add-user' component={AddUser}/>
                                <Route path='/admin/show-user' component={ShowUser}/>
                                <Route path='/admin/add-product' component={AddProduct}/>
                                <Route path='/admin/show-product' component={ShowProduct}/>
                                <Route path='/admin/edit-product/:id' component={EditProduct}/>
                                <Route path='/admin/edit-user/:id' component={EditUser}/>
                                <Route exact path='/admin' component={Home}/>
                            </Switch>
                       {/* End Content */}
                    </div>
                </Content>
                <Footer style={{ textAlign: 'center' }} >
                    Ant Design ??2018 Created by Ureka
                </Footer>
            </Layout>
        </Layout>
    )
}

export default Admin
