using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using RateCalculatorClient.RateCalculatorReference ;

namespace RateCalculatorClient
{
    public class TestCase
    {
        #region "Members"
            private int _ID = 0;
            private string _Text = string.Empty;
            private string _Description = string.Empty;
            private RateCalculatorRequest _RateRequest = null;
            private RateCalculatorResponse _RateResponse = null;
        #endregion

        #region "Properties"
            public int ID
            {
                get { return _ID; }
                set { _ID = value; }
            }

            public string Text
            {
                get { return _Text; }
                set { _Text = value; }
            }

            public string Description
            {
                get { return _Description; }
                set { _Description = value; }
            }

            public RateCalculatorRequest RateRequest
            {
                get { return _RateRequest; }
                set { _RateRequest = value; }
            }

            public RateCalculatorResponse RateResponse
            {
                get { return _RateResponse; }
                set { _RateResponse = value; }
            }
        #endregion

        #region "Constructors"
            public TestCase(int ID, 
                            string Text, 
                            string Description,
                            RateCalculatorRequest RateRequest,
                            RateCalculatorResponse RateResponse)
            {
                _ID = ID;
                _Text = Text;
                _Description = Description;
                _RateRequest = RateRequest;
                _RateResponse = RateResponse;
            }
        #endregion
    }
}
