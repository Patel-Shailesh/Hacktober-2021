#include<iostream.h>
#include<conio.h>
int mg[12];
int yg(int y)
{ int l,m;
  l=(y/100)%4;
  switch(l)
  { case 0  : m=6;
    case 1  : m=4;
    case 2  : m=2;
    case 3  : m=0;
  }
  return m;
}
void disp(int i)
{ switch(i)
 { case 0  :  cout<<"Sunday";
break;
   case 1  :  cout<<"Monday";
break;
   case 2  :  cout<<"Tuesday";
break;
   case 3  :  cout<<"Wednesday";
break;
   case 4  :  cout<<"Thursday";
break;
   case 5  :  cout<<"Friday";
break;
   case 6  :  cout<<"Saturday";
 }
}
int mong( int y, int m)
 {
  if(y%100==0)
    {
      if(y%400==0)y=1;
        else y=0;
     }
    else if(y%4==0)
      {y=1;}
	else
	 {y=0;}
   if(y==1)
     {int mg[12]= {0,3,4,0,2,5,0,3,6,1,4,6};}
    else
     {int mg[12]={0,3,3,6,1,4,6,2,5,0,3,5};}
     int k = mg[m];
  return k;
  }

void main()
{int d,m,y,x,r,z,s;
 clrscr();
 cout<<"Enter Date (dd mm yyyy format): ";
 cin>>d>>m>>y;
 x=mong(y,m);
 s=y%100;
 r=yg(y);
 z=x+r+s+d;
 z=z%7;
 disp(z);
 getch();
}
