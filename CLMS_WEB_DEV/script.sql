USE [clsms]
GO
/****** Object:  Table [dbo].[Course]    Script Date: 25/09/2018 6:10:30 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Course](
	[CourseID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[CourseName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Course] PRIMARY KEY CLUSTERED 
(
	[CourseID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Delivery]    Script Date: 25/09/2018 6:10:32 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Delivery](
	[DeliveryID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[DateofIssue] [date] NULL,
	[IssueNumber] [varchar](50) NULL,
	[VolumeNumber] [varchar](50) NULL,
	[ExpectedReceiveDate] [date] NOT NULL,
	[ReceiveDate] [date] NULL,
 CONSTRAINT [PK_Delivery] PRIMARY KEY CLUSTERED 
(
	[DeliveryID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Department]    Script Date: 25/09/2018 6:10:32 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Department](
	[DepartmentID] [varchar](10) NOT NULL,
	[DepartmentName] [varchar](50) NOT NULL,
	[DepartmentImage] [nchar](50) NULL,
 CONSTRAINT [PK_Department] PRIMARY KEY CLUSTERED 
(
	[DepartmentID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Distributor]    Script Date: 25/09/2018 6:10:32 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Distributor](
	[DistributorID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorName] [varchar](50) NOT NULL,
	[NameOfIncharge] [varchar](50) NOT NULL,
	[ContactNumber] [varchar](25) NOT NULL,
	[Email] [varchar](50) NULL,
 CONSTRAINT [PK_Distributor] PRIMARY KEY CLUSTERED 
(
	[DistributorID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notification]    Script Date: 25/09/2018 6:10:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notification](
	[NotificationID] [int] IDENTITY(1,1) NOT NULL,
	[SerialID] [int] NOT NULL,
	[NotificationType] [varchar](100) NOT NULL,
	[NotificationSeen] [varchar](50) NOT NULL,
	[Date] [datetime] NOT NULL,
 CONSTRAINT [PK_Notification] PRIMARY KEY CLUSTERED 
(
	[NotificationID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[ReceiveSerial]    Script Date: 25/09/2018 6:10:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[ReceiveSerial](
	[ReceivedSerialID] [int] IDENTITY(1,1) NOT NULL,
	[DepartmentID] [varchar](10) NOT NULL,
	[SerialID] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
	[RSDate] [datetime] NULL,
 CONSTRAINT [PK_ReceiveSerial] PRIMARY KEY CLUSTERED 
(
	[ReceivedSerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Serial]    Script Date: 25/09/2018 6:10:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Serial](
	[SerialID] [int] IDENTITY(1,1) NOT NULL,
	[TypeID] [int] NOT NULL,
	[SerialName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Serial] PRIMARY KEY CLUSTERED 
(
	[SerialID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Subscription]    Script Date: 25/09/2018 6:10:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Subscription](
	[SubscriptionID] [int] IDENTITY(1,1) NOT NULL,
	[DistributorID] [int] NOT NULL,
	[SerialID] [int] NOT NULL,
	[Orders] [varchar](50) NOT NULL,
	[Cost] [int] NOT NULL,
	[NumberOfItemReceived] [int] NOT NULL,
	[Status] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Subscription] PRIMARY KEY CLUSTERED 
(
	[SubscriptionID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Type]    Script Date: 25/09/2018 6:10:33 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Type](
	[TypeID] [int] IDENTITY(1,1) NOT NULL,
	[TypeName] [varchar](50) NOT NULL,
 CONSTRAINT [PK_Type] PRIMARY KEY CLUSTERED 
(
	[TypeID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[User]    Script Date: 25/09/2018 6:10:34 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[User](
	[UserID] [int] IDENTITY(1,1) NOT NULL,
	[UserName] [varchar](50) NOT NULL,
	[Password] [varchar](50) NOT NULL,
	[FirstName] [varchar](50) NOT NULL,
	[LastName] [varchar](50) NOT NULL,
	[Avatar] [varchar](100) NOT NULL,
	[Email] [varchar](50) NOT NULL,
	[Role] [varchar](25) NOT NULL,
 CONSTRAINT [PK_User] PRIMARY KEY CLUSTERED 
(
	[UserID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[Delivery] ON 

INSERT [dbo].[Delivery] ([DeliveryID], [DistributorID], [DateofIssue], [IssueNumber], [VolumeNumber], [ExpectedReceiveDate], [ReceiveDate]) VALUES (10, 6, NULL, NULL, NULL, CAST(N'2017-12-20' AS Date), CAST(N'2017-12-20' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [DistributorID], [DateofIssue], [IssueNumber], [VolumeNumber], [ExpectedReceiveDate], [ReceiveDate]) VALUES (11, 7, NULL, N'1', N'8', CAST(N'2017-12-20' AS Date), CAST(N'2017-12-20' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [DistributorID], [DateofIssue], [IssueNumber], [VolumeNumber], [ExpectedReceiveDate], [ReceiveDate]) VALUES (13, 8, CAST(N'2017-10-01' AS Date), N'8', N'17', CAST(N'2017-12-20' AS Date), CAST(N'2017-12-20' AS Date))
INSERT [dbo].[Delivery] ([DeliveryID], [DistributorID], [DateofIssue], [IssueNumber], [VolumeNumber], [ExpectedReceiveDate], [ReceiveDate]) VALUES (14, 9, CAST(N'2017-09-23' AS Date), N'22', N'3', CAST(N'2017-10-20' AS Date), NULL)
INSERT [dbo].[Delivery] ([DeliveryID], [DistributorID], [DateofIssue], [IssueNumber], [VolumeNumber], [ExpectedReceiveDate], [ReceiveDate]) VALUES (15, 10, NULL, N'7', N'3', CAST(N'2017-10-19' AS Date), NULL)
SET IDENTITY_INSERT [dbo].[Delivery] OFF
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName], [DepartmentImage]) VALUES (N'COL', N'College', N'College.png                                       ')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName], [DepartmentImage]) VALUES (N'ELEM', N'Elementary', N'Elementary.png                                    ')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName], [DepartmentImage]) VALUES (N'HS', N'HighSchool', N'High.png                                          ')
INSERT [dbo].[Department] ([DepartmentID], [DepartmentName], [DepartmentImage]) VALUES (N'SHS', N'Senior High School', N'Senior.jpg                                        ')
SET IDENTITY_INSERT [dbo].[Distributor] ON 

INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (6, N'Emerald', N'Mark Daniel', N'09969876321', N'markdaniel@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (7, N'FJM', N'Kyle', N'09215642278', N'kylejohn@yahoo.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (8, N'Library Journals', N'John Hajie', N'09987318849', N'hajie@gmail.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (9, N'EESM', N'Vince', N'09982223321', N'vincejayson@yahoo.com')
INSERT [dbo].[Distributor] ([DistributorID], [DistributorName], [NameOfIncharge], [ContactNumber], [Email]) VALUES (10, N'Agdamag', N'Carl', N'09221446325', N'joshua@rocketmail.com')
SET IDENTITY_INSERT [dbo].[Distributor] OFF
SET IDENTITY_INSERT [dbo].[Notification] ON 

INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (11, 8, N'Received', N'Seen', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (13, 9, N'Received', N'Seen', CAST(N'2017-12-15T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (14, 9, N'Received', N'Seen', CAST(N'2018-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (15, 9, N'Received', N'Seen', CAST(N'2018-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (17, 9, N'Received', N'Seen', CAST(N'2018-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (18, 9, N'Received', N'Seen', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (19, 10, N'Delayed', N'Not Seen', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (20, 10, N'Delayed', N'Not Seen', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (21, 10, N'Delayed', N'Not Seen', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (24, 11, N'Delayed', N'Not Seen', CAST(N'2017-10-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (25, 11, N'Delayed', N'Not Seen', CAST(N'2017-10-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (26, 11, N'Delayed', N'Not Seen', CAST(N'2017-10-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (27, 11, N'Delayed', N'Not Seen', CAST(N'2017-10-20T00:00:00.000' AS DateTime))
INSERT [dbo].[Notification] ([NotificationID], [SerialID], [NotificationType], [NotificationSeen], [Date]) VALUES (28, 12, N'Delayed', N'Not Seen', CAST(N'2017-10-19T00:00:00.000' AS DateTime))
SET IDENTITY_INSERT [dbo].[Notification] OFF
SET IDENTITY_INSERT [dbo].[ReceiveSerial] ON 

INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [RSDate]) VALUES (7, N'COL', 12, N'Received', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [RSDate]) VALUES (8, N'ELEM', 8, N'Received', CAST(N'2017-12-20T00:00:00.000' AS DateTime))
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [RSDate]) VALUES (9, N'ELEM', 9, N'Received', CAST(N'2017-12-12T00:00:00.000' AS DateTime))
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [RSDate]) VALUES (10, N'SHS', 11, N'Not Received', NULL)
INSERT [dbo].[ReceiveSerial] ([ReceivedSerialID], [DepartmentID], [SerialID], [Status], [RSDate]) VALUES (11, N'HS', 10, N'Not Received', NULL)
SET IDENTITY_INSERT [dbo].[ReceiveSerial] OFF
SET IDENTITY_INSERT [dbo].[Serial] ON 

INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (8, 2, N'National Geographic')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (9, 1, N'The Professional Teacher')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (10, 2, N'Animal Scene')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (11, 1, N'Issues in Accounting Education (AAA)')
INSERT [dbo].[Serial] ([SerialID], [TypeID], [SerialName]) VALUES (12, 2, N'Liwayway')
SET IDENTITY_INSERT [dbo].[Serial] OFF
SET IDENTITY_INSERT [dbo].[Subscription] ON 

INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (7, 6, 8, N'2', 2000, 1, N'On Going')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (8, 7, 9, N'5', 5000, 5, N'Finished')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (9, 8, 10, N'3', 3000, 3, N'FInished')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (13, 9, 11, N'4', 30090, 0, N'Refunded')
INSERT [dbo].[Subscription] ([SubscriptionID], [DistributorID], [SerialID], [Orders], [Cost], [NumberOfItemReceived], [Status]) VALUES (14, 10, 12, N'1', 1000, 0, N'Cancelled')
SET IDENTITY_INSERT [dbo].[Subscription] OFF
SET IDENTITY_INSERT [dbo].[Type] ON 

INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (1, N'Journal')
INSERT [dbo].[Type] ([TypeID], [TypeName]) VALUES (2, N'Magazine')
SET IDENTITY_INSERT [dbo].[Type] OFF
SET IDENTITY_INSERT [dbo].[User] ON 

INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role]) VALUES (1, N'akumao', N'admin', N'mark', N'tabbu', N'asd', N'asd', N'asd')
INSERT [dbo].[User] ([UserID], [UserName], [Password], [FirstName], [LastName], [Avatar], [Email], [Role]) VALUES (2, N'hajie', N'admin2', N'hajie', N'nub', N'asd', N'asd', N'asd')
SET IDENTITY_INSERT [dbo].[User] OFF
ALTER TABLE [dbo].[Course]  WITH CHECK ADD  CONSTRAINT [FK_Course_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
GO
ALTER TABLE [dbo].[Course] CHECK CONSTRAINT [FK_Course_Department]
GO
ALTER TABLE [dbo].[Delivery]  WITH CHECK ADD  CONSTRAINT [FK_Delivery_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
GO
ALTER TABLE [dbo].[Delivery] CHECK CONSTRAINT [FK_Delivery_Distributor]
GO
ALTER TABLE [dbo].[Notification]  WITH CHECK ADD  CONSTRAINT [FK_Notification_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
GO
ALTER TABLE [dbo].[Notification] CHECK CONSTRAINT [FK_Notification_Serial]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Department] FOREIGN KEY([DepartmentID])
REFERENCES [dbo].[Department] ([DepartmentID])
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Department]
GO
ALTER TABLE [dbo].[ReceiveSerial]  WITH CHECK ADD  CONSTRAINT [FK_ReceiveSerial_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
GO
ALTER TABLE [dbo].[ReceiveSerial] CHECK CONSTRAINT [FK_ReceiveSerial_Serial]
GO
ALTER TABLE [dbo].[Serial]  WITH CHECK ADD  CONSTRAINT [FK_Serial_Type] FOREIGN KEY([TypeID])
REFERENCES [dbo].[Type] ([TypeID])
GO
ALTER TABLE [dbo].[Serial] CHECK CONSTRAINT [FK_Serial_Type]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Distributor] FOREIGN KEY([DistributorID])
REFERENCES [dbo].[Distributor] ([DistributorID])
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Distributor]
GO
ALTER TABLE [dbo].[Subscription]  WITH CHECK ADD  CONSTRAINT [FK_Subscription_Serial] FOREIGN KEY([SerialID])
REFERENCES [dbo].[Serial] ([SerialID])
GO
ALTER TABLE [dbo].[Subscription] CHECK CONSTRAINT [FK_Subscription_Serial]
GO
