import React from 'react';
import { Form, Input } from 'antd';

function ProductForm(props) {
    return (
        <div>
            <Form.Item
                name="type_prod"
                label="Type"
                key={'prod'}
                initialValue='prod'
            >
                <Input disabled value='prod' />
            </Form.Item>
            <Form.Item
                name="url"
                label="Url"
                rules={[
                    {
                        required: true,
                        message: "Please enter URL"
                    },
                ]}
            >
                <Input />
            </Form.Item>
        </div>
    );
}

export default ProductForm;