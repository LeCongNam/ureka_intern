import React from 'react';
import { Form, Input } from 'antd';

function DevForm() {
    return (
        <div>
            <Form.Item
                name="type"
                label="Type"
                key={'dev'}
                initialValue='dev'
            >
                <Input disabled value='dev' />
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

export default DevForm;
