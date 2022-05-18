import React from 'react';
import { Link, useHistory } from 'react-router-dom';
import {
  DesktopOutlined,
  UserOutlined,
} from '@ant-design/icons';
import { Menu } from 'antd';



function getItem(label, key, icon, children) {
  return {
    key,
    icon,
    children,
    label,
  };
}

function Sidebar() {
  const history = useHistory()
  const items = [
    getItem('User', 'sub1', <UserOutlined />, [
      getItem('Add Group User', 'add-group'),
      getItem('Add User', 'add-user'),
      getItem('Show List User', 'show-user'),
    ]),
    getItem('Product', 'sub2', <DesktopOutlined />,
      [
        getItem('Add Product', 'add-product'),
        getItem('Show Product', 'show-product')
      ]),
  ]

  function gotoPage(item) {
    let path = '/admin/' + item.key
    console.log(path);
    history.push(path)
  }

  return (
    <div>
      <Link to="/admin">
        <div className="logo" id='header__logo' style={{
          backgroundImage: "url('/image/logo.svg')",
          width: '200px',
          height: " 50px",
          backgroundRepeat: "no-repeat",
          position: "relative",
          top: "19px",
          left: "19px",
        }} />
      </Link>
      <Menu theme="dark" defaultSelectedKeys={['1']} mode="inline" items={items} onClick={gotoPage} />
    </div>
  );
}

export default Sidebar;